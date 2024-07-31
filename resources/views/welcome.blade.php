@extends('layouts.app')
@section('content')
<style>
.said{margin-top: 30px;

}
@media only screen and (min-width:1025px) {
    .said{width: 46%}
}
</style>
    @if (app()->getLocale() == 'ar')
        <style>
            @media only screen and (max-width: 600px) {
                .navbar {
                    width: 485px;
                }
            }


            @media only screen and (min-width:1025px) {


                .carousel-item img {
                    height: 500px;
                }

                .carousel-item {
                    height: 500px;
                }

                /* width: 1519px; */
                .navbar {
                    width: 1519px;
                }
            }

            #app {
                margin-left: 96px;
            }


        </style>
    @else
    <style>
         @media only screen and (max-width: 600px) {
            #app {
                margin-right: 115px;
            }

                 .navbar {
                    width: 485px;
                }
            }

    </style>
    @endif
    <style>
        .books .carousel-item {}

        .books .btn-success {
            width: 195px;
        }

        .books .text-center {
            margin-top: 21px;
        }

        .courses .carousel-item {}

        .courses .btn-success {
            width: 195px;
        }


        .one {
            margin: 0 auto;
            /* important */
            width: 100px;
            height: 200px;
            position: relative;
            perspective: 1000px;
        }

        .carousel {
            margin-top: 67px;
            height: 100%;
            width: 100%;
            position: absolute;
            transform-style: preserve-3d;
            transition: transform 1s;
        }

        .item {
            display: block;
            position: absolute;
            background: #000;
            width: 200px;
            height: 200px;
            line-height: 200px;
            font-size: 5em;
            text-align: center;
            color: #FFF;
            opacity: 0.95;
            border-radius: 10px;
        }

        .a {
            transform: rotateY(0deg) translateZ(250px);
            background: #ed1c24;
        }

        .b {
            transform: rotateY(60deg) translateZ(250px);
            background: #0072bc;
        }

        .c {
            transform: rotateY(120deg) translateZ(250px);
            background: #39b54a;
        }

        .d {
            transform: rotateY(180deg) translateZ(250px);
            background: #f26522;
        }

        .e {
            transform: rotateY(240deg) translateZ(250px);
            background: #630460;
        }

        .f {
            transform: rotateY(300deg) translateZ(250px);
            background: #8c6239;
        }

        .next,
        .prev {
            color: #444;
            position: absolute;
            top: 100px;
            padding: 1em 2em;
            cursor: pointer;
            background: #CCC;
            border-radius: 5px;
            border-top: 1px solid #FFF;
            box-shadow: 0 5px 0 #999;
            transition: box-shadow 0.1s, top 0.1s;
        }

        .next:hover,
        .prev:hover {
            color: #000;
        }

        .next:active,
        .prev:active {
            top: 104px;
            width: 10px,
                box-shadow: 0 1px 0 #999;
        }

        .next {
            right: 5em;
        }

        .prev {
            left: 5em;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <div class="container">


        <div class="one">
            <div class="carousel">
                @foreach ($sliders as $index =>$slider)
                @if ($index==0)
                <div class="item a" style="width: 150px">
                    <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                </div>
                @endif

                @if ($index==1)
                <div class="item b" style="width: 150px">
                    <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                </div>
                @endif

                @if ($index==2)
                <div class="item c" style="width: 150px">
                    <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                </div>
                @endif

                @if ($index==3)
                <div class="item d" style="width: 150px">
                    <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                </div>
                @endif

                @if ($index==4)
                <div class="item e" style="width: 150px">
                    <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                </div>
                @endif

                @if ($index==5)
                <div class="item f" style="width: 150px">
                    <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                </div>
                @endif

                @endforeach

            </div>
        </div>
        <h2 style="margin-top: 165px; font-size: xxx-large; font-family: system-ui;"> @lang('auth.about_amr') </h2>
        <p style="font-size: x-large; font-family: system-ui;">
            {{-- {{app()->getLocale() == 'ar' ? $settings->setting_site_address_ar:$settings->setting_site_address_en}} --}}
            @if (app()->getLocale() == 'ar')
            <?php echo $settings->setting_site_address_ar; ?>
        @else
            <?php echo $settings->setting_site_address_en; ?>
        @endif
        </p>

        <h2 style="margin-top: 30px ;margin-bottom: 30px; font-size: xxx-large; font-family: system-ui;">@lang('auth.books')
        </h2>

        <div class="books">
            {{-- <div id="books" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @if (app()->getLocale() == 'ar')
                        <button type="button" data-bs-target="#books" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#books" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#books" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    @else
                        <button type="button" data-bs-target="#books" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#books" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#books" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    @endif
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ URL('images/books/book1.jpeg') }}" class="d-block w-100 " alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ URL('images/books/book3.jpeg') }}" class="d-block w-100 " alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ URL('images/books/book4.jpeg') }}" class="d-block w-100 " alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#books" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#books" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div> --}}
            <div class="row" style="margin: auto">
                <div class="one">
                    <div class="carousel">
                        @foreach ($books as $index =>$slider)
                        @if ($index==0)
                        <div class="item a" style="width: 150px">
                            <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                        </div>
                        @endif

                        @if ($index==1)
                        <div class="item b" style="width: 150px">
                            <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                        </div>
                        @endif

                        @if ($index==2)
                        <div class="item c" style="width: 150px">
                            <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                        </div>
                        @endif

                        @if ($index==3)
                        <div class="item d" style="width: 150px">
                            <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                        </div>
                        @endif

                        @if ($index==4)
                        <div class="item e" style="width: 150px">
                            <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                        </div>
                        @endif

                        @if ($index==5)
                        <div class="item f" style="width: 150px">
                            <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                        </div>
                        @endif

                        @endforeach

                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('users.books') }} " class="btn btn-success" style="margin-top: 165px;">
                    @lang('auth.buy_book') <i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
        <h2 style="margin-top: 30px ;margin-bottom: 30px; font-size: xxx-large; font-family: system-ui;">@lang('auth.courses')
        </h2>

        <div class="courses">

            <div class="one">
                <div class="carousel">

                    @foreach ($courses as $index =>$slider)
                    @if ($index==0)
                    <div class="item a" style="width: 150px">
                        <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                    </div>
                    @endif

                    @if ($index==1)
                    <div class="item b" style="width: 150px">
                        <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                    </div>
                    @endif

                    @if ($index==2)
                    <div class="item c" style="width: 150px">
                        <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                    </div>
                    @endif

                    @if ($index==3)
                    <div class="item d" style="width: 150px">
                        <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                    </div>
                    @endif

                    @if ($index==4)
                    <div class="item e" style="width: 150px">
                        <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                    </div>
                    @endif

                    @if ($index==5)
                    <div class="item f" style="width: 150px">
                        <img src="{{ asset('mainImages/' . $slider->articles_image) }}" alt="..." style="height: 100%;width: 150px">
                    </div>
                    @endif

                    @endforeach

                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('allcourses') }}" class="btn btn-success" style="margin-top: 165px;"> @lang('auth.buy_course')
                    <i class="fas fa-shopping-cart"></i></a>
            </div>
            <h2 style="margin-top: 30px; font-size: xxx-large; font-family: system-ui;"> @lang('auth.said')</h2>

            <div class="row" >
                @foreach ($testoninals as $item )
                <img src="{{asset('mainImages/' . $item->articles_image) }}" alt="..." style="height: fit-content" class="said">
                @endforeach


            </div>



            <div class="text-center" style="margin-top: 15px;">
                <a href="{{ route('users.sessions') }}" class="btn btn-success"> @lang('auth.buy_session') <i
                        class="fas fa-shopping-cart" ></i></a>
            </div>
            {{-- <div class="text-center" style="margin-top: 20px">
                <img src="{{ URL('images/moving/13p.jpeg') }}" alt="..." style="">
            </div> --}}

        </div>
        <script>
            var carousel = $(".carousel"),
                currdeg = 0;

            setInterval(rotate, 2000);

            function rotate(e) {
                currdeg = currdeg - 60
                /*if(e.data.d=="n"){
                  currdeg = currdeg - 60;
                }
                if(e.data.d=="p"){
                  currdeg = currdeg + 60;
                }*/
                carousel.css({
                    "-webkit-transform": "rotateY(" + currdeg + "deg)",
                    "-moz-transform": "rotateY(" + currdeg + "deg)",
                    "-o-transform": "rotateY(" + currdeg + "deg)",
                    "transform": "rotateY(" + currdeg + "deg)"
                });
            }
        </script>
    @endsection
