@extends('layouts.app')
@section('content')
    <style>
        .form-group {
            margin-bottom: 10px !important;
        }

        label {
            font-size: x-large;
        }
    </style>
    {{-- {{$sessions}}  --}}
    <div class="container">
        <h1 style="margin-top: 20px;">@lang('auth.Please Fill the form to book your Session')</h1>
        <form method="POST" action="{{ route('session.pay') }}">
            @csrf
            <div class="form-group">
                <label for="email">@lang('auth.Email Address')</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="name">@lang('auth.Username')</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">@lang('auth.Phone')</label>
                <input type="number" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="session_time">@lang('auth.Session time :')</label>
                <input type="text" class="form-control" id="session_time" placeholder="@lang('auth.Please select the appropriate time for you for session')" name="session_time" required>
            </div>
            <div class="form-group">
                <label for="type" style="display: block;">@lang('auth.Type_s')</label>
                <input type="radio" id="online" name="type" value="online" required>
                <label for="online">@lang('auth.Online_s')</label><br>
                <input type="radio" id="offline" name="type" value="offline" required>
                <label for="offline">@lang('auth.Offline_s')</label><br>
            </div>
            <div class="form-group">
                <label for="session_type" style="display: block;">@lang('auth.session_t')</label>
                @foreach ($sessions as $session)
                    <input type="radio" id="session_type_{{ $session->id }}" name="session_type" value="{{ $session->id }}" required>
                    <label for="session_type_{{ $session->id }}">
                        {{ $session->session_type }} [@lang('auth.Online_s'): {{ $session->price_online }} $ | @lang('auth.Offline_s'): {{ $session->price_offline }} $]
                    </label><br>
                @endforeach
            </div>
            <button type="submit" class="btn btn-danger" name="action" value="paypal">@lang('auth.Book your Session now') <i class="fas fa-shopping-cart"></i></button><br>
            <button type="submit" class="btn btn-dark" style="margin-top: 10px;" name="action" value="paymob">@lang('auth.paymob_session') <i class="fas fa-shopping-cart"></i></button>
        </form>

        <div class="row">
            <div class="text-center" style="margin-top: 20px;">
                <img src="{{ URL('images/moving/13p.jpeg') }}" alt="..." style="width:100%">
            </div>
        </div>
    </div>
@endsection
