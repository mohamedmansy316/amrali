@extends('layouts.app')
@section('content')
<style>
    .form-group {
        margin-bottom: 10px;
         !important
    }

    label {
        font-size: x-large;
    }

</style>
@if (session('session_edited'))
    <div class="alert alert-warning">
        {{ session('session_edited') }}
    </div>
@endif

<div class="container">
    <h1 style="margin-top: 10px">Edit Session page</h1>
    <form method="POST"  action="{{route('sessions.update',$session->id)}}">
        {{ csrf_field() }}
        @method('PUT')

        <div class="form-group">
            <label for="exampleInputEmail1">Old Session Type</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{$session->session_type}}"  readonly>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">New Session Type</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="if you dont enter value old session type will remain" name="new_session_type">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Old Price online</label>
            <input type="number" class="form-control" id="exampleInputPassword1" value="{{$session->price_online}}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New Price online</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  placeholder="if you dont enter value old online price will remain" name="new_price_online">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Old Price offline</label>
            <input type="number" class="form-control" id="exampleInputPassword1" value="{{$session->price_offline}}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> New Price offline</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  placeholder="if you dont enter value old offline price will remain" name="new_price_offline" >
        </div>
        <button type="submit" class="btn btn-warning">Edit</button>
    </form>
    <a href="{{route('sessions.index')}}" class="btn btn-primary" style="margin-top: 10px">Back to Sessions page</a>

</div>
@endsection
