@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-success">
       @lang('auth.reserve')
    </div>
    <a href="{{route('users.books')}}" class="btn btn-primary">@lang('auth.Back to Books page')</a>
</div>

@endsection
