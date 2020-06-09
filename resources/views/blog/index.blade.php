@extends('layouts.master')

@section('content')

    @foreach($posts as $post)
        <div class="row">
            <div class="col-md-12 text-center">

                <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">{{ $post->title }}</a></p>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
