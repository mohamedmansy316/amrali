@extends('layouts.app')
@section('content')
<style>
    .form-group{
        margin-bottom: 10px;!important
    }
</style>
    <div class="container">
        <h1 style="margin-top: 10px">@lang('auth.Add Client by Admin') </h1>
        @if (session('clientAdminsave'))
            <div class="alert alert-success">
                {{ session('clientAdminsave') }}
            </div>
        @endif
        <form method="POST" action="{{ route('storeAdmin') }}">
            @csrf
            {{-- price --}}
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Email Address')</label>
                <input type="email" class="form-control" id="exampleInputPassword1" name="email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" style="font-size: x-large">@lang('auth.Username')</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Phone')</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="phone" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.book name')</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="book_name" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1" style="margin-top: 10px;display: block;font-size: x-large">@lang('auth.Type') :</label>
                <input type="radio" name="type" value="pdf" required>
                <label>@lang('auth.pdf') </label><br>
                <input type="radio" name="type" value="insideEgypt" required>
                <label>@lang('auth.hard') </label><br>
                <input type="radio" name="type" value="outsideEgypt" required>
                <label>@lang('auth.hard o') </label><br>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Address')</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="address">
            </div>
            <div class="alert alert-warning" role="alert" style="margin-top: 10px">
                @lang('auth.Address_alert')
            </div>

            <button type="submit" class="btn btn-success">@lang('auth.Add Client') </button>
        </form>
        <a href="{{route('clients.index')}}" class="btn btn-primary" style="margin-top: 10px">@lang('auth.Back to Clinet Admin Page')</a>

    </div>
@endsection
