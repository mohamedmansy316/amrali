@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success">
       @lang('auth.reserve')
    </div>
    <a href="{{route('allcourses')}}" class="btn btn-primary">@lang('auth.Back to courses page')</a>
</div>
@endsection
