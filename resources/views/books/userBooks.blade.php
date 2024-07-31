@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 style="margin-top: 10px"> @lang('auth.Books') </h1>
        <hr>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-6 my-1">
                    <div class="card m-auto">
                     @if ($book->name == 'كتاب العلاج بالطاقة الحيوية(النسخة العربية)')
                        <iframe width="100%" height="328px" src="https://www.youtube.com/embed/YwruKCHVJTs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @elseif($book->name == 'Bioenergy therapy book(English version)')
                        <iframe width="100%" height="328px" src="https://www.youtube.com/embed/MXvsGNAkdJY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                        <div class="m-auto">
                        <img class="card-img-top" src="{{ asset('upload_books/' . $book->picture) }}" alt="Card image cap"
                        style="max-width: 300px">
                        </div>
                        @endif
                        <!--<iframe width="560" height="315" src="https://www.youtube.com/embed/YwruKCHVJTs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        <div class="card-body">
                            {{-- free book --}}
                            @if ($book->name == 'خرائط القران الكريم')
                            <div class="m-auto">
                                <h3 class="card-title">{{ $book->name }}</h3>
                                <div class="card-text" style="font-size: x-large">
                                <div class="alert alert-success" role="alert">
                                    <p style="font-size: x-large; font-family: system-ui;"> @lang('auth.free') </p>
                                </div>
                                </div>
                                <a href="{{ route('buybooksform', [$book->id, $book->name]) }}" class="btn btn-success">
                                    @lang('auth.download') <i class="fas fa-shopping-cart"></i></a>
                                {{-- <a href="{{route('book.download',$book->id)}}" class="btn btn-success" style="margin-bottom: 10px">@lang('auth.download') <i class="fas fa-shopping-cart"></i></a> --}}
                            @else
                                {{-- paid book --}}
                                <h3 class="card-title">{{ $book->name }}</h3>
                                <p class="card-text" style="font-size: x-large">@lang('auth.price : 1$')</p>
                                <ul>
                                    <li style="font-size: large">@lang('auth.pdf')  {{ $book->pdf}} $</li>
                                    <li style="font-size: large">@lang('auth.hard')  {{ $book->inside_Egypt}} $</li>
                                    <li style="font-size: large">@lang('auth.hard o') {{ $book->outside_Egypt}} $</li>
                                </ul>
    
                                <a href="{{ route('buybooksform', [$book->id, $book->name]) }}" class="btn btn-danger">
                                    @lang('auth.Buy now') <i class="fas fa-shopping-cart"></i></a> <br>
                                <a href="{{ route('cashOnDelivaryForm', [$book->id, $book->name]) }}" class="btn btn-dark" style="margin-top: 10px">
                                    @lang('auth.cash on delivary') <i class="fas fa-shopping-cart"></i></a> <br>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        @if (LaravelLocalization::getCurrentLocale() == 'en')
            <a href="{{ url('/en') }}" class="btn btn-primary" style="text-align: center">Back to Home
                page</a>
        @else
            <a href="{{ url('/') }}" class="btn btn-primary" style="text-align: center">الرجوع للصفحة
                الرئيسية</a>
        @endif

    </div>
@endsection
