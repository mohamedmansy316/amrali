
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
@if (session('session_saved'))
    <div class="alert alert-success">
        {{ session('session_saved') }}
    </div>
@endif
<div class="container">
    <h1 style="margin-top: 10px">Create online session page </h1>
    <form method="POST"  action="{{route('sessions.store')}}">
        @csrf
        <div class="form-group"  >
          <label for="exampleInputEmail1">Session type</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="session_type">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Price Online</label>
          <input type="number" class="form-control" id="exampleInputPassword1" name="price_online" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Price Offline</label>
            <input type="number" class="form-control" id="exampleInputPassword1" name="price_offline" >
          </div>
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{route('sessions.index')}}" class="btn btn-primary" > back to Sessions page</a>
      </form>
</div>
@endsection
