@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        @foreach ($certificates as $certificate )

        <img src="{{ asset('certificates/' . $certificate->name) }}" alt="" >
        <hr style="font-weight:900">
        @endforeach
        </div>
    </div>
@endsection
