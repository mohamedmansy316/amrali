@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success">
        @lang('auth.success') {{ $id }}
    </div>

    <div class="card" style="width: 30rem;">
        <!--<img class="card-img-top" src="{{ asset('storage/upload_courses/' . $course->course_picture) }}" alt="Card image cap">-->
        <h3 class="card-title text-center alert alert-success" style="margin-bottom: -40px;">{{ $course->course_name }}</h3> 
        <div class="card-body">
            <h3 class="card-title">{{ $course->name }}</h3>
        </div>
        <a href="{{route('course.download',$course->id)}}" class="btn btn-success" style="margin-bottom: 10px">@lang('auth.download')</a>
        <a href="{{route('allcourses')}}" class="btn btn-primary">@lang('auth.Back to courses page')</a>
    </div>
</div>

@endsection
