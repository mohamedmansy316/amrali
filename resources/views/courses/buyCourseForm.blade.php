<style>
    .form-group{
        margin-bottom: 10px;!important
    }
</style>
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>@lang('auth.Buy Course Form') </h1>
    {{-- action="{{ route('course.pay') }}" --}}
    <form method="POST" action="{{ route('course.pay') }}"  >
        @csrf
        {{-- price --}}
         {{-- <input type="text" name="course_name" value="{{$course->course_name}}" readonly> --}}
         <div class="form-group">
            <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.bookedcourse')</label>
            <input type="email" class="form-control" id="exampleInputPassword1" name="course_name" value="{{$course->course_name}}" readonly>
        </div>
        <input type="hidden" name="course_id" value="{{ $course->id }}">
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
            <input type="radio"   name="type" value="book_online" required>
            <label >Download online for : {{$course->price_online}} $</label><br>
            <input type="radio"    name="type" value="book_offline" required>
            <label >Book offline for: {{$course->price_offline}} $ </label><br>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" style="font-size: x-large">@lang('auth.Address')</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="address">
        </div>
        <button type="submit" class="btn btn-danger" name="action" value="paypal"> @lang('auth.paypal') <i
                class="fas fa-shopping-cart"></i></button>
        <button type="submit" class="btn btn-dark" name="action" value="paymob"> @lang('auth.paymob') <i
                    class="fas fa-shopping-cart"></i></button>
    </form>

</div>
@endsection
