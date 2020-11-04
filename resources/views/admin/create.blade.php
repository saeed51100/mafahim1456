@extends('layouts.master')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.create') }}" enctype="multipart/form-data" method="post">
                <p>

                    <input type='file' name="photo" id="photo"/>
                    <img id="blah" src="#" alt="your image " height="100" width="120">

                    <script>
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function (e) {
                                    $('#blah').attr('src', e.target.result);
                                }

                                reader.readAsDataURL(input.files[0]); // convert to base64 string
                            }
                        }

                        $("#photo").change(function () {
                            readURL(this);
                        });

                    </script>


                </p>
                <br>
                <br>
                <br>
                <br>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control" id="content" name="content">
                </div>
                @foreach($tags as $tag)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
@endsection
