@extends('layouts.app')
@section('content')
<style>
    .form-group{
        margin-bottom: 10px;!important
    }
</style>
    <div class="container">
        <h1 style="margin-top: 10px;">@lang('auth.cash on delivary Form')</h1>
            {{-- this for all paid books --}}
            <form method="POST" action="{{ route('cashOnDelivaryCreate') }}">
                @csrf
                {{-- price --}}
                 {{-- <input type="hidden" name="book_name" value="{{$book_name}}"> --}}
                <input type="hidden" name="book_id" value="{{ $book_id }}">
                <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.bookedBook')</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" name="book_name" value="{{$book_name}}" readonly>
                </div>
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
                    <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Address')</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="address">
                </div>
                <div class="alert alert-warning" role="alert" style="margin-top: 10px">
                   @lang('auth.Address_cash_alert')
                  </div>

                <button type="submit" class="btn btn-dark"> @lang('auth.Order now') <i
                        class="fas fa-shopping-cart"></i></button>
            </form>


    </div>
@endsection
