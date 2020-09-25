@extends('layouts.master')

@section('content')

    
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
