@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success">
       @lang('auth.reserve')
    </div>
    <a href="{{url('/')}}" class="btn btn-primary"> @lang('auth.Back to Home page')</a>
</div>
@endsection
