<style>
    /* @media only screen and (max-width:1025px) {

   footer .one{
    width: 71%;
   }
 } */
    .iframe-container {
        position: relative;
        /* width: 100%; */
        padding-bottom: 56.25%;
        height: 0;
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    footer .two {
        width: 91%;
    }

    @media only screen and (max-width: 600px) {
        footer .two {
            width: 73%;
        }
    }

    @media only screen and (min-width:1025px) {
        .card {
            margin: 30px;
        }
    }
</style>
<!doctype html>
@if (app()->getLocale() == 'ar')
    <html lang="{{ app()->getLocale() }}" dir="rtl">
@else
    <html lang="{{ app()->getLocale() }}" dir="ltl">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('AmrAli.com', 'AmrAli.com') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <div id="app">
        {{-- <iframe src="{{ asset('amrali.mp3') }}"  allow="autoplay" type="audio/mpeg" muted></iframe> --}}
        {{-- <audio    autoplay controls   id="myaudio" >
            <source src="{{ asset('amrali.mp3') }}" type="audio/ogg">
            <source src="{{ asset('amrali.mp3') }}" type="audio/mpeg">
          </audio> --}}
        {{-- <div class="iframe-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/kJ_lJoU08XY?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div> --}}
        {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/pQRus0Qba6I?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            @if (LaravelLocalization::getCurrentLocale() == 'en')
                <a class="navbar-brand" href="{{ url('/en') }}" title="@lang('auth.home')">
                    <img src="{{ URL('images/logo_e.jpeg') }}" style="width: 106px;">
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}" title="@lang('auth.home')">
                    <img src="{{ URL('images/logo_e.jpeg') }}" style="width: 106px;">
                </a>
            @endif
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        {{-- <li class="nav-item active"> <a href="https://wa.me/1019633445" target="_blank" class="nav-link">+20</a> </li> --}}
                        {{-- <li class="nav-item active"> <p class="nav-link"> <i class="fa-solid fa-phone"></i> +201019633445</p> </li> --}}
                        <li class="nav-item active"> <a href="{{ route('users.books') }} " class="nav-link"
                                title="@lang('auth.buy_book')">
                                @lang('auth.my_books')</a> </li>
                        <li class="nav-item active"> <a href="{{ route('allcourses') }}" class="nav-link"
                                title="@lang('auth.buy_course')"> @lang('auth.my_courses')</a> </li>
                        <li class="nav-item active">
                            <a href="{{ route('users.sessions') }}" target="" class="nav-link"
                                title="@lang('auth.buy_session')">@lang('auth.my_sessions')</a>
                        </li>
                        <li class="nav-item active"> <a href="https://www.facebook.com/Yatafakron/" target="_blank"
                                title="@lang('auth.Yatafakron·Education')" class="nav-link">@lang('auth.about_us') </a> </li>
                        <li class="nav-item active"> <a href="{{ route('userCertificates') }}"
                                title="@lang('auth.certificates')" class="nav-link"> @lang('auth.certificates') </a> </li>
                        <li class="nav-item active"> <a href="{{ route('videos') }}" target="" class="nav-link"
                                title="@lang('auth.enjoy our videos now')">
                                @lang('auth.Videos')</a> </li>

                        <li class="nav-item active"> <a href="{{ route('returns') }}" target="" class="nav-link"
                            title="@lang('auth.returns')">
                            @lang('auth.returns')</a> </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/login') }}">
                                        @lang('auth.login')
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <!--<li class="nav-item">-->
                                <!--    <a class="nav-link" href="{{ LaravelLocalization::localizeUrl('/register') }}">-->
                                <!--        @lang('auth.register')-->
                                <!--    </a>-->
                                <!--</li>-->
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->rule_id == 1)
                                        <a class="dropdown-item" href="{{ route('certificates.index') }}">
                                            <strong>صفحة الشهادات</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('books.index') }}">
                                            <strong>صفحة الكتب</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('courses.index') }}">
                                            <strong> صفحة الكورسات</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('clients.index') }}">
                                            <strong>صفحة حجوزات الكتب</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('sessions.index') }}">
                                            <strong>صفحة الجلسات</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.sessions') }}">
                                            <strong> حجوزات العملاء</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('consults.index') }}">
                                            <strong> صفحة انواع الاستشارات</strong>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('mainslider.index') }}">
                                            <strong> معرض الصور الرئيسي</strong>
                                        </a>

                                        <a class="dropdown-item" href="{{ route('mainslider.create') }}">
                                            <strong> معرض صور المؤلفات</strong>
                                        </a>

                                        <a class="dropdown-item" href="{{ route('mainslider.show', 3) }}">
                                            <strong> معرض صور الكورسات</strong>
                                        </a>

                                        <a class="dropdown-item" href="{{ route('mainslider.show', 4) }}">
                                            <strong> معرض صور اراء العملاء</strong>
                                        </a>

                                        <a class="dropdown-item" href="{{ route('mainslider.edit', 5) }}">
                                            <strong> صفحة الاعدادات</strong>
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                        <strong> {{ __('Logout') }} </strong>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li class="nav-item">

                            <div>
                                <a id="instagram1" target="_blank" title="instagram" style="text-decoration: none">
                                    <img src="{{ URL('images/moving/instagram.png') }}" style="height: 33px;"> | </a>
                                <a id="telegram1" target="_blank" title="Telegram" style="text-decoration: none">
                                    <img src="{{ URL('images/moving/telegram.png') }}" style="height: 33px;"> |
                                </a>
                                <a id="youtube1" target="_blank" title="you tube" style="text-decoration: none">
                                    <img src="{{ URL('images/moving/youtube.png') }}" style="height: 33px;"> |
                                </a>
                                <a id="fb1" target="_blank" title="facebook" style="text-decoration: none">
                                    <img src="{{ URL('images/moving/facebook.png') }}" style="height: 33px;">
                                </a>

                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Config::get('languages')[App::getLocale()] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                @endif
                            @endforeach
                            </div>
                        </li> --}}
                        <li class="nav-item dropdown" style="min-width: 8rem;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ app()->getLocale() == 'ar' ? 'Arabic' : 'English' }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item"
                                    href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                    English</a>
                                <a class="dropdown-item"
                                    href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">Arabic</a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/kJ_lJoU08XY?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer>
    <style>
        footer a {
            padding: 5px;
        }
    </style>
    <hr>
    <div style="display: flex">
        <div class="two">
            <a id="instagram2" target="_blank" title="instagram" style="text-decoration: none">
                <img src="{{ URL('images/moving/instagram.png') }}" style="height: 33px;"> | </a>
            <a id="telegram2" target="_blank" title="Telegram" style="text-decoration: none">
                <img src="{{ URL('images/moving/telegram.png') }}" style="height: 33px;"> |
            </a>
            <a id="youtube2" target="_blank" title="you tube" style="text-decoration: none">
                <img src="{{ URL('images/moving/youtube.png') }}" style="height: 33px;"> |
            </a>
            <a id="fb2" target="_blank" title="facebook" style="text-decoration: none">
                <img src="{{ URL('images/moving/facebook.png') }}" style="height: 33px;">
            </a>
            <p style="font-size: large;">@lang('auth.Follow us now to recieve all new')</p>
        </div>

        <div>
            <div>
                {{-- href="https://api.whatsapp.com/send?phone=NUMBER
                whatsapp.png --}}
                <p style="text-align: center;margin-bottom: -4px;"> <a id="whatsapp" target="_blank"
                        title="whatsapp"> <img src="{{ URL('images/moving/whatsapp.png') }}" style="height: 33px;">
                    </a> </p>
                <p style="font-size: large;">@lang('auth.contact_us')</p>
            </div>
        </div>
    </div>
    <div class="alert alert-secondary" role="alert" style="margin-top: 10px;">
        <p class="text-center">@lang('auth.All rights reserved to Amr Ali') </p>
    </div>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/629d2dd87b967b11799305ae/1g4qvm5sb';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    {{-- </div> --}}

</footer>

<script>
    async function get() {
        const response = await fetch('/api/settings');

        console.log('response');
        //console.log(response.data);
        //id="youtube2"
        //id="telegram2"
        //id="fb2" whatsapp
        let setting = await response.json();

        document.getElementById('instagram1').href = setting.setting_instgramurl;
        document.getElementById('instagram2').href = setting.setting_instgramurl;

        document.getElementById('youtube2').href = setting.setting_youtubeurl;
        document.getElementById('youtube1').href = setting.setting_youtubeurl;

        document.getElementById('telegram2').href = setting.setting_telegramurl;
        document.getElementById('telegram1').href = setting.setting_telegramurl;

        document.getElementById('fb2').href = setting.setting_facebookurl;
        document.getElementById('fb1').href = setting.setting_facebookurl;

        document.getElementById('whatsapp').href = setting.setting_whatsappurl;

        console.log(setting);
    }

    get();
</script>

</html>
