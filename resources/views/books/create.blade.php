@extends('layouts.app')
@section('content')
<style>
  h3{margin-bottom: 20px}
  /* h1{margin-top: 50px} */
</style>
    <div class="container">

        <h1  style="margin-top: 10px"> @lang('auth.Add Book')</h1>

        @if (session('book'))
            <div class="alert alert-success">
                {{ session('book') }}
            </div>
        @endif
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <h3>@lang('auth.Enter the name of the book')</h3>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="@lang('auth.Enter the name of the book')" name="name" style="width: 80%;"  required>
            </div>
            <hr>
            <div class="form-group">
                <h3>@lang('auth.pdf_price')</h3>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                     name="price_pdf" style="width: 80%;"  required>
            </div>
            <hr>
            <div class="form-group">
                <h3>@lang('auth.inside_price')</h3>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                     name="price_inside" style="width: 80%;"  required>
            </div>
            <hr>
            <div class="form-group">
                <h3>@lang('auth.outside_price')</h3>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                     name="price_outside" style="width: 80%;"  required>
            </div>
            <hr>
            <div class="form-group">
                <h3>@lang('auth.Upload Book Picture')</h3>
                <input type="file" class="form-control" id="exampleInputPassword1" name="photo" style="width: 80%;" required>
            </div>
            <hr>
            <div class="form-group">
                <h3>@lang('auth.Upload your Book')</h3>
                <input type="file" class="form-control" id="exampleInputPassword1" name="book_pdf" style="width: 80%;" required>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">@lang('auth.Upload')</button>
            <a href="{{route('books.index')}}" class="btn btn-primary" > @lang('auth.Back to All Books Page')</a>
        </form>

    </div>
@endsection
