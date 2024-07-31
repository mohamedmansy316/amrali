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
@if (session('book_edited'))
    <div class="alert alert-warning">
        {{ session('book_edited') }}
    </div>
@endif
<div class="container">
    <h1 style="margin-top: 10px">Edit books page</h1>
    <form method="POST" action="{{route('books.update',$book->id)}}">
        @csrf
        @method('PUT')
         {{-- old name --}}
        <div class="form-group">
            <h3>Old Name</h3>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
         value="{{$book->name}}" style="width: 80%;"  readonly>
        </div>

        <div class="form-group">
            <h3>@lang('auth.Enter the name of the book')</h3>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="@lang('auth.Enter the name of the book')" name="name" style="width: 80%;"  >
        </div>
        <hr>
         {{-- old pdf price --}}
         <div class="form-group">
            <h3>Old pdf price</h3>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 value="{{$book->pdf}}" style="width: 80%;"  readonly>
        </div>

        <div class="form-group">
            <h3>@lang('auth.pdf_price')</h3>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 name="price_pdf" style="width: 80%;"  >
        </div>
        <hr>
        {{-- old inside Egypt price --}}
        <div class="form-group">
            <h3>Old inside Egypt price</h3>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 value="{{$book->inside_Egypt}}" style="width: 80%;"  readonly>
        </div>
        <div class="form-group">
            <h3>@lang('auth.inside_price')</h3>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 name="price_inside" style="width: 80%;"  >
        </div>
        <hr>
         {{-- old outside Egypt price --}}
         <div class="form-group">
            <h3>Old outside Egypt price</h3>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 value="{{$book->outside_Egypt}}" style="width: 80%;"  readonly>
        </div>

        <div class="form-group">
            <h3>@lang('auth.outside_price')</h3>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                 name="price_outside" style="width: 80%;"  >
        </div>
        <hr>
        <button type="submit" class="btn btn-warning">@lang('auth.edit')</button>
        <a href="{{route('books.index')}}" class="btn btn-primary" > @lang('auth.Back to All Books Page')</a>
    </form>
</div>
@endsection
