<?php 
use App\Models\GeneralSettings as gs;
$gs = gs::get()->first();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" type="image/png" href="{{ getFile('icon', @$gs->favicon) }}"> --}}
    <title>
        @if (@$gs->sitename)
            {{ __(@$gs->sitename) . '-' }}
        @endif
        {{ __(@$pageTitle) }}
    </title>
    <link href="{{ asset('asset/theme2/frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('asset/theme2/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/font-awsome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/iziToast.min.css') }}">
    <link href="{{ asset('asset/theme2/frontend/css/style.css') }}" rel="stylesheet">
    <style type="text/css">
        .logout:hover{
            background: transparent;
            color: green!important;
            transition: .5sec;
        }
    </style>
    {{-- <link rel="stylesheet"
        href="{{ asset('asset/theme2/frontend/css/color.php?primary_color=' . str_replace('#', '', @$gs->primary_color)) }}"> --}}


    @stack('style')

</head>

<body>

    @if (@$gs->preloader_status)
        <div id="preloader"></div>
    @endif



    @if (@$gs->analytics_status)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ @$gs->analytics_key }}"></script>
        <script>
            'use strict'
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());
            gtag("config", "{{ @$gs->analytics_key }}");
        </script>
    @endif

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="d-flex flex-wrap align-items-center">
                <button type="button" class="sidebar-open-btn me-3">
                    <i class="bi bi-arrow-bar-left"></i>
                    <i class="bi bi-arrow-bar-right"></i>
                </button>
                <h1 class="logo me-auto me-lg-0 ">
                    <a href="{{ url('/') }}">
                     <div style="width: 200px; ">
                         <svg viewBox="0 0 134 32" fill="none" xmlns="http://www.w3.org/2000/svg" data-v-548022aa=""><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7704 1.16329L11.5566 7.81411L10.3246 13.6477L17.1006 8.63871L27.0081 17.7879L15.7704 1.16329ZM30.2623 20.9562L23.0298 4.00032L20.2321 6.34897L30.2623 20.9562Z" fill="#EAECEF" data-v-548022aa=""></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M31.1215 25.9284L27.4868 18.9463L23.0669 14.9607L24.0019 23.349L11.1469 27.3788L31.1215 25.9284ZM25.0425 30.8171L24.4142 27.2119L6.79077 28.6206L25.0425 30.8171Z" fill="#EAECEF" data-v-548022aa=""></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5619 25.3688L7.85089 21.987L10.7984 8.8056L2.06394 26.8806L9.90994 27.2144L15.5619 25.3688ZM11.9052 4.3979L0.883484 19.1573L4.31197 20.4139L11.9052 4.3979ZM24.0043 23.349L11.1493 27.3788L31.1214 25.9259L24.0043 23.349Z" fill="#EAECEF" data-v-548022aa=""></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.85085 21.987L10.7983 8.80805L2.0639 26.8806L7.85085 21.987ZM17.1006 8.63871L27.0082 17.7879L15.7705 1.16329L17.1006 8.63871Z" fill="#EAECEF" data-v-548022aa=""></path> <path d="M45.264 21H41.056V10.328H45.264C46.9387 10.328 48.2987 10.8187 49.344 11.8C50.4 12.7813 50.928 14.072 50.928 15.672C50.928 17.272 50.4053 18.5627 49.36 19.544C48.3147 20.5147 46.9493 21 45.264 21ZM45.264 19C46.288 19 47.0987 18.68 47.696 18.04C48.304 17.4 48.608 16.6107 48.608 15.672C48.608 14.6907 48.3147 13.8907 47.728 13.272C47.1413 12.6427 46.32 12.328 45.264 12.328H43.328V19H45.264ZM60.8924 21H53.3404V10.328H60.8924V12.328H55.6124V14.584H60.7804V16.584H55.6124V19H60.8924V21ZM73.1485 21H70.4285L67.7565 17.096L65.0685 21H62.3645L66.2365 15.528L62.6045 10.328H65.3085L67.7565 13.976L70.1725 10.328H72.9085L69.2765 15.512L73.1485 21ZM77.4856 17.992H73.6456V16.264H77.4856V17.992ZM84.5705 21H82.2825V12.328H79.1625V10.328H87.6745V12.328H84.5705V21ZM98.571 21H95.963L93.867 17.208H92.203V21H89.931V10.328H94.923C96.0217 10.328 96.891 10.648 97.531 11.288C98.1817 11.928 98.507 12.7547 98.507 13.768C98.507 14.6427 98.2777 15.352 97.819 15.896C97.371 16.44 96.8217 16.7867 96.171 16.936L98.571 21ZM94.587 15.208C95.0563 15.208 95.4403 15.08 95.739 14.824C96.0377 14.5573 96.187 14.2053 96.187 13.768C96.187 13.3307 96.0377 12.984 95.739 12.728C95.4403 12.4613 95.0563 12.328 94.587 12.328H92.203V15.208H94.587ZM110.964 21H108.372L107.716 19.192H103.14L102.468 21H99.8762L104.004 10.328H106.852L110.964 21ZM107.092 17.192L105.428 12.6L103.764 17.192H107.092ZM116.958 21H112.75V10.328H116.958C118.632 10.328 119.992 10.8187 121.038 11.8C122.094 12.7813 122.622 14.072 122.622 15.672C122.622 17.272 122.099 18.5627 121.054 19.544C120.008 20.5147 118.643 21 116.958 21ZM116.958 19C117.982 19 118.792 18.68 119.39 18.04C119.998 17.4 120.302 16.6107 120.302 15.672C120.302 14.6907 120.008 13.8907 119.422 13.272C118.835 12.6427 118.014 12.328 116.958 12.328H115.022V19H116.958ZM132.586 21H125.034V10.328H132.586V12.328H127.306V14.584H132.474V16.584H127.306V19H132.586V21Z" fill="#F8FAFD" data-v-548022aa=""></path></svg>
        </div>
                    </a>
                </h1>
            </div>
            <div class="header-right d-flex">
                <select class="changeLang" aria-label="Default select example">
                   {{-- @foreach ($language_top as $top)
                        <option value="{{ $top->short_code }}"
                            {{ session('locale') == $top->short_code ? 'selected' : '' }}>
                            {{ __(ucwords($top->name)) }}
                            English
                        </option>
                    @endforeach --}}
                </select>
                <div class="dropdown ms-3">
                    <button class="dropdown-toggle user-toggle-menu" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (@Auth::user()->image)
                            <img src="{{ asset(auth()->user()->image) }}" alt="pp">
                        @else
                            <img src="{{ asset('asset/theme2/frontend/img/user.png') }}" alt="pp">
                        @endif
                        <span class="text-white ms-2">{{ auth()->user()->full_name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <!-- <li><a class="dropdown-item" href="{{ url('user.2fa') }}">{{ __('2FA') }}</a></li> -->
                        <li><a class="dropdown-item" href="{{ route('settings.index') }}">{{ __('Settings') }}</a></li>
                        
                        <li>
                            <form method="post" action="{{route('logout')}}" style="display: inline-block;background: transparent;color: white;">
                            @csrf
                                <button class="dropdown-item logout" style="color:white;padding: 0px;margin: 5px 20px" >{{ __('Logout') }}</button>
                            </form>
                        </li>    
                        
                            
                    </ul>
                </div>
            </div>

        </div>
    </header><!-- End Header -->


    <main id="main" class="dashboard-main">
        <section class="dashboard-section">

            @include(template().'layout.user_sidebar')
            @yield('content2')
        </section>
    </main>

   

    <script src="{{ asset('asset/theme2/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/selectric.min.js') }}"></script>

    <script src="{{ asset('asset/theme2/frontend/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/user_dashboard.js') }}"></script>

    @stack('script')
    @if (@$gs->twak_allow)
        <script type="text/javascript">
            'use strict'
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "https://embed.tawk.to/{{ @$gs->twak_key }}";
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            "use strict";
            iziToast.error({
                message: "{{ session('error') }}",
                position: 'topRight'
            });
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            "use strict";
            iziToast.success({
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        </script>
    @endif

    @if (session()->has('notify'))
        @foreach (session('notify') as $msg)
            <script>
                "use strict";
                iziToast.{{ $msg[0] }}({
                    message: "{{ trans($msg[1]) }}",
                    position: "topRight"
                });
            </script>
        @endforeach
    @endif

    @if (@$errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
                iziToast.error({
                message: '{{ __($error) }}',
                position: "topRight"
                });
            @endforeach
        </script>
    @endif


    <script>
        'use strict'
        var url = "{{ url('user.changeLang') }}";

        $(".changeLang").change(function() {
            if ($(this).val() == '') {
                return false;
            }
            window.location.href = url + "?lang=" + $(this).val();
        });

        // responsive menu slideing
        $(".d-sidebar-menu>li>a").on("click", function() {
            var element = $(this).parent("li");
            if (element.hasClass("open")) {
                element.removeClass("open");
                element.find("li").removeClass("open");
                element.find("ul").slideUp(500, "linear");
            } else {
                element.addClass("open");
                element.children("ul").slideDown();
                element.siblings("li").children("ul").slideUp();
                element.siblings("li").removeClass("open");
                element.siblings("li").find("li").removeClass("open");
                element.siblings("li").find("ul").slideUp();
            }
        });

        $('.sidebar-open-btn').on('click', function() {
            $(this).toggleClass('active');
            $('.d-sidebar').toggleClass('active');
        });
    </script>
</body>

</html>
