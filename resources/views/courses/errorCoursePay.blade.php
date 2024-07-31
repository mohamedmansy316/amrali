@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-danger">
        @lang('auth.error')
    </div>
    <a href="{{route('users.sessions')}}" class="btn btn-primary"> back to booking sessions page</a>
</div>

@endsection
