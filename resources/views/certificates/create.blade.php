@extends('layouts.app')
@section('content')
@if (session('certificate'))
<div class="alert alert-success">
    {{ session('certificate') }}
</div>
@endif
    <div class="container">
        <h1 style="margin-top: 10px">Add Certificate page </h1>
        <form method="POST" action="{{ route('certificates.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputPassword1" style="font-size: x-large">Certificate</label>
                <input type="file" class="form-control" id="exampleInputPassword1" name="certificate" required>
            </div>

            <button type="submit" class="btn btn-success" style="margin-top: 10px">add Certificate</button>
        </form>
        <a href="{{route('certificates.index')}}" class="btn btn-primary" style="margin-top: 10px">Back to certificates Admin page</a>

    </div>
@endsection
