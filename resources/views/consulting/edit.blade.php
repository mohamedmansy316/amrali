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
@if (session('consult_updated'))
    <div class="alert alert-warning">
        {{ session('consult_updated') }}
    </div>
@endif

<div class="container">
    <h1 style="margin-top: 10px">Edit Consult page</h1>
    <form method="POST"  action="{{route('consults.update',$consult->id)}}">
        {{ csrf_field() }}
        @method('PUT')

        <div class="form-group">
            <label for="exampleInputEmail1">Old Consult Type</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{$consult->consult_type}}"  readonly>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">New Consult Type</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="if you dont enter value old session type will remain" name="consult_type">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Old Price online</label>
            <input type="number" class="form-control" id="exampleInputPassword1" value="{{$consult->price_online}}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New Price online</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  placeholder="if you dont enter value old online price will remain" name="price_online">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Old Price offline</label>
            <input type="number" class="form-control" id="exampleInputPassword1" value="{{$consult->price_offline}}" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> New Price offline</label>
            <input type="number" class="form-control" id="exampleInputPassword1"  placeholder="if you dont enter value old offline price will remain" name="price_offline" >
        </div>
        <button type="submit" class="btn btn-warning">Edit</button>
    </form>
    <a href="{{route('consults.index')}}" class="btn btn-primary" style="margin-top: 10px">Back to Consults page</a>

</div>
@endsection
