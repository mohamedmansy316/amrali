@extends('layouts.app')
@section('content')
<style>
    .form-group{
        margin-bottom: 10px;!important
    }
</style>
    <div class="container">
        <h1 style="margin-top: 10px;">@lang('auth.Buy Books Form')</h1>
        @if ($book_name == 'خرائط القران الكريم')

                @if (session('clientsaved'))
                <div class="alert alert-success" role="alert">
                   @lang('auth.Enjoy our Free Book now')
                  </div>
                  <P>  <a href="{{ route('book.download', $book_id) }}" class="btn btn-success"
                        style="margin-bottom: 10px">@lang('auth.download') <i class="fas fa-shopping-cart"></i></a> </p>
                       <p> <a href="{{route('users.books')}}" class="btn btn-primary" >@lang('auth.Back to Books page')</a> </p>
                @else
                   {{-- this is for free book --}}
            {{-- this route is in client controller --}}
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                {{-- <input type="hidden" name="amount" value="1"> --}}
                <input type="hidden" name="book_id" value="{{ $book_id }}">
                <input type="hidden"  name="type" value="pdf">
                <input type="hidden" name="book_name" value="{{$book_name}}">

                <div class="form-group" style="margin-bottom: 10px">
                    <label for="exampleInputPassword1"  style="font-size: x-large"> @lang('auth.Email Address')</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" name="email" required>
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"  style="font-size: x-large">@lang('auth.Username')</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Phone')</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Address')</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="address">
                </div>
                    <button type="submit" class="btn btn-success"  style="margin-top: 10px"> @lang( 'auth.submit_download')<i
                            class="fas fa-shopping-cart"></i></button>
                @endif

            </form>
        @else
            {{-- this for all paid books --}}
            {{-- action="{{ route('payment') }}" --}}
            <form method="POST" action="{{ route('payment') }}" >
                @csrf
                {{-- price --}}
                <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.bookedBook')</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" name="book_name" value="{{$book_name}}" readonly>
                </div>
                 {{-- <input type="hidden" name="book_name" value="{{$book_name}}"> --}}
                <input type="hidden" name="book_id" value="{{ $book_id }}">
                <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Email Address')</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" name="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"  style="font-size: x-large">@lang('auth.Username')</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"  style="font-size: x-large">@lang('auth.Phone')</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" style="margin-top: 10px;display: block;font-size: x-large">@lang('auth.Type') :</label>
                    <input type="radio"   name="type" value="pdf" required>
                    <label >@lang('auth.pdf')</label><br>
                    <input type="radio"    name="type" value="insideEgypt" required>
                    <label >@lang('auth.hard')</label><br>
                    <input type="radio"    name="type" value="outsideEgypt" required>
                    <label >@lang('auth.hard o')</label><br>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Address')</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="address">
                </div>
                <div class="alert alert-warning" role="alert" style="margin-top: 10px">
                   @lang('auth.Address_alert')
                  </div>

                <button type="submit" class="btn btn-danger" name="action" value="paypal"> @lang('auth.paypal') <i
                        class="fas fa-shopping-cart"></i></button>
                        
                <button type="submit" class="btn btn-dark" name="action" value="paymob"> @lang('auth.paymob') <i
                        class="fas fa-shopping-cart"></i></button>
            </form>
        @endif

    </div>
@endsection
