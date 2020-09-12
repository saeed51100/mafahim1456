<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">

    <title>Laravel</title>
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/all.css')}}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body>
@include('partials.header')
{{--<div class="container">--}}
{{--    @yield('content')--}}
{{--</div>--}}

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light text-right sidebar collapse">
            <div class="sidebar-sticky pt-3">

                @foreach($posts as $post)
                    <div class="row">
                        <div class="col-md-12 text-center">

                            <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">{{ $post->title }}</a></p>
                        </div>
                    </div>
                @endforeach

            </div>
        </nav>

        <main role="main" class="col-md-9 mr-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <div class="container">
                @yield('content')
            </div>

            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

        </main>
    </div>
</div>


<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
