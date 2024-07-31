@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success">
            @lang('auth.success') {{ $id }}
        </div>

        <div class="card" style="width: 30rem;">
            <img class="card-img-top" src="{{ asset('upload_books/' . $book->picture) }}" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">{{ $book->name }}</h3>
                <p class="card-text" style="font-size: x-large"></p>
            </div>
            <a href="{{route('book.download',$book->id)}}" class="btn btn-success" style="margin-bottom: 10px">@lang('auth.download')</a>
            <a href="{{route('users.books')}}" class="btn btn-primary">@lang('auth.Back to Books page')</a>
        </div>
    </div>
@endsection
