@extends('layouts.master')

@section('content')


    {{--    Use @if for define variable $imgname in blade template.
     The only downside is your assignment will look like a mistake to someone
     not aware that you're doing this as a workaround.
     You can change the code later...     --}}


    {{--        @if ($imgname = (collect((collect($post->images))->get('0')))->get('imgname')) @endif--}}

    @if($imgname = $post->images->pluck('imgname')->first()) @endif
{{--        @dd($imgname)--}}


    <img src="/storage/{{$imgname}}" alt="profile Pic" height="200" width="780">

    <div class="row">
        <div class="col-md-12">
            <p class="quote">{{ $post->title }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{ count($post->likes) }} Likes |
                <a href="{{ route('blog.post.like', ['id' => $post->id]) }}">Like</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{ $post->content }}</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <p style="font-weight: bold">
        @foreach($post->tags as $tag)
            - {{ $tag->name }} -
        @endforeach
    </p>
@endsection
