@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-danger">
        @lang('auth.error')
    </div>
    <a href="{{route('users.books')}}" class="btn btn-primary"> @lang('auth.Back to Books page')</a>
</div>

@endsection
