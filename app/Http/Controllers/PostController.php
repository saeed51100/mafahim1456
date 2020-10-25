<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Tag;
use App\Image;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function getRandPost()
    {
        $post = Post::inRandomOrder()->with('likes')->first();
        return view('blog.post', ['post' => $post]);
    }

    public function getIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex()
    {
        $posts = Post::orderBy('title', 'asc')->get();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $post = Post::where('id', $id)->with('likes')->first();
        return view('blog.post', ['post' => $post]);
    }

    public function getLikePost($id)
    {
        $post = Post::where('id', $id)->first();
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->route('blog.post', $post->id);
    }

    public function getAdminCreate()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            "photo" => 'required | file | image | mimes:jpeg,png,gif,webp | max:1024',
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $filename = 'profile-photo-' . time() . '.' . $extension;
        $path = $file->storeAs('photos', $filename);

//        dd($path);

        $user = Auth::user();
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $user->posts()->save($post);
//        $user = Auth::user();
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        $image = new Image([
            'imgname' => $filename
        ]);
        $post->images()->save($image);


//        dd($path);


//        $popp = DB::table('posts')->get()->last();
//        $bb = collect($popp)->get('id');
//        dd($bb);

//        $mm = Post::all()->last();
//        $bb = collect($mm)->get('id');
//        dd($bb);

//        $pathToDelete = base_path() . '' . basename($post->featured);

        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));

    }

    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = Post::find($request->input('id'));
        if (Gate::denies('manipulate-post', $post)) {
            return redirect()->back();
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
//        $post->tags()->detach();
//        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

    public function getAdminDelete($id)
    {
        $post = Post::find($id);
        if (Gate::denies('manipulate-post', $post)) {
            return redirect()->back();
        }


        $mm = $post->images()->get();
        $bb = collect($mm)->get('0');
        $zz = collect($bb)->get('imgname');

        $pathtodelete = 'photos/' . $zz;
//        dd($pathtodelete);
        Storage::delete($pathtodelete);


        $post->likes()->delete();
        $post->images()->delete();
        $post->tags()->detach();
        $post->delete();


        return redirect()->route('admin.index')->with('info', 'Post deleted!');
    }
}
