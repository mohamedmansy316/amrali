
<style>
    .form-group {
        margin-bottom: 10px;
         !important
    }

    label {
        font-size: x-large;
    }

</style>
@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <head>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    </head>

    <body>
        @if (session('course'))
            <div class="alert alert-success">
                {{ session('course') }}
            </div>
        @endif
        @if (session('course_error'))
        <div class="alert alert-danger">
            {{ session('course_error') }}
        </div>
    @endif

        <div class="container mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-2 mb-2">Upload online courses Admin page</h1>

                    <form action="{{ route('insertcourse') }}" method="post" enctype="multipart/form-data"
                        id="image-upload" class="dropzone">
                        {{-- @csrf --}}
                        {{ csrf_field() }}
                        {{-- {{ csrf_token() }} --}}
                        <h3>Upload Course By Click On Box please upload course first and then fill the rest data to Upload </h3>
                </div>
                </form>


                <form method="POST" wire:submit.prevent="save" action="{{ route('courses.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="exampleInputEmail1">course name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="course_name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Price online</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="price_online">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Price offline</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="price_offline">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Upload course picture </label>
                        <input type="file" class="form-control" name="course_picture">
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                    <a href="{{route('courses.index')}}" class="btn btn-primary">Back to online Courses Admin page</a>
                </form>

            </div>
        </div>
        </div>

        <script type="text/javascript">
            //$('meta[name="csrf-token"]').attr('content');
            Dropzone.options.imageUpload = {
                maxFilesize: 9000,
                acceptedFiles: ".rar,.zip"
            };
        </script>
    @endsection
</body>

</html>
