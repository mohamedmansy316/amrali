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
@if (session('course_edited'))
    <div class="alert alert-warning">
        {{ session('course_edited') }}
    </div>
@endif
    <div class="container">
        <h1 style="margin-top: 10px"> Edit course</h1>

        <form method="POST"  action="{{route('courses.update',$course->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1"> old course name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    value="{{$course->course_name}}"  readonly>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1"> new course name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="new_course_name"  >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">new course video</label>
                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="new_video"  >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Old Price online</label>
                <input type="number" class="form-control" id="exampleInputPassword1" value="{{$course->price_online}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Price online</label>
                <input type="number" class="form-control" id="exampleInputPassword1"  placeholder="if you dont enter value old online price will remain" name="new_price_online">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Old Price offline</label>
                <input type="number" class="form-control" id="exampleInputPassword1" value="{{$course->price_offline}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> New Price offline</label>
                <input type="number" class="form-control" id="exampleInputPassword1"  placeholder="if you dont enter value old offline price will remain" name="new_price_offline" >
            </div>
            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
        <a href="{{route('courses.index')}}" class="btn btn-primary">Back to online Courses Admin page</a>
    </div>
@endsection
