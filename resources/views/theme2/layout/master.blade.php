<?php
use App\Models\GeneralSettings as GS;
$gs = GS::get()->first();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="{{ getFile('icon', @$general->favicon) }}">

    <title>

        {{$gs->sitename}}
    </title>

    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/cookie.css') }}">
    <link href="{{ asset('asset/theme2/frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('asset/theme2/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme2/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/font-awsome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/line-awesome.min.css') }}">
    <link href="{{ asset('asset/theme2/frontend/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/iziToast.min.css') }}">

    @stack('style')

{{--   <link rel="stylesheet" href="{{ asset('asset/theme2/frontend/css/color.php?primary_color=' . str_replace('#', '', @$general->primary_color)) }}">--}}
</head>


<body data-bs-spy="scroll" data-bs-target="#mainNavbar" data-bs-offset="100" tabindex="0">

{{--    @if (@$general->preloader_status)--}}
        <div id="preloader"></div>
{{--    @endif--}}


{{--    @if (@$general->allow_modal)--}}
{{--        @include('cookieConsent::index')--}}
{{--    @endif--}}


{{--    @if (@$general->analytics_status)--}}
{{--        <script async src="https://www.googletagmanager.com/gtag/js?id={{ @$general->analytics_key }}"></script>--}}
{{--        <script>--}}
{{--            'use strict'--}}
{{--            window.dataLayer = window.dataLayer || [];--}}

{{--            function gtag() {--}}
{{--                dataLayer.push(arguments);--}}
{{--            }--}}
{{--            gtag("js", new Date());--}}
{{--            gtag("config", "{{ @$general->analytics_key }}");--}}
{{--        </script>--}}
{{--    @endif--}}


    @include(template().'layout.header')
    <main id="main" class="main-img">

        @yield('content')

    </main>


    @include(template().'layout.footer')

    {{-- back to to btn jobas --}}

    <button type="button" class="cmn-btn btn-sm btn-floating" id="btn-back-to-top">
        <i class="fas fa-arrow-up text-light"></i>
    </button>

    <script src="{{ asset('asset/theme2/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/selectric.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/main.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('asset/theme2/frontend/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });
    </script>
    @stack('script')
    @if (@$general->twak_allow)
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "https://embed.tawk.to/{{ @$general->twak_key }}";
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
                message: "{{ __($error) }}",
                position: "topRight"
                });
            @endforeach
        </script>
    @endif




<script>


    function updateTable() {
        // Define an array of names and profile pictures
        var names = ['Prediger', 'Tark01', 'Prediger', 'Fred40','Rodriguez','Clara80','Chloe','Viki12','mdfahim12','Maryann','josh12'];
        var profilePictures = ['user.png'];
        var types = ['Deposit','Withdrawal']
        // Generate random data for each row
        var data = [];
        for (var i = 0; i < 20; i++) {
            var name = names[Math.floor(Math.random() * names.length)];
            var profilePicture = profilePictures[Math.floor(Math.random() * profilePictures.length)];
            const type = types[Math.floor(Math.random() * types.length)];
            var amount = Math.floor(Math.random() * 1000) + 1; // Generate a random amount between 1 and 1000
            data.push({ name: name, profilePicture: profilePicture,type:type, amount: amount });
        }
        // http://localhost:6001/asset/theme2/frontend/img/user.png
        console.log(data)
        var table = $('#transactions');
        table.find('tbody').empty();
        $.each(data, function(index, value) {
            var row = $('<tr>');

            var profilePic = $('<img>').attr('src', '{{ asset('asset/theme2/frontend/img/') }}/' + value.profilePicture);
            var name = $('<td>').text(value.name);
            var type = $('<td>').text(value.type);
            if (value.type == 'Deposit') {
                type.addClass('text-danger');
            } else {
                type.addClass('text-success');
            }
            var amount = $('<td>').text('$' + value.amount);
            row.append($('<td>').append(profilePic)).append(name).append(type).append(amount)
            table.find('tbody').append(row);
        });

        // Schedule the next update
        setTimeout(updateTable, 5000); // Update every 5 seconds
    }

    $(document).ready(function() {
        updateTable();
    });
</script>
{{--    <script>--}}
{{--        'use strict'--}}


{{--        $(document).on('submit', '#subscribe', function(e) {--}}
{{--            e.preventDefault();--}}
{{--            const email = $('.subscribe-email').val();--}}
{{--            var url = "{{ route('subscribe') }}";--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}

{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                url: url,--}}
{{--                data: {--}}
{{--                    email: email,--}}
{{--                },--}}
{{--                success: (data) => {--}}
{{--                    iziToast.success({--}}
{{--                        message: data.message,--}}
{{--                        position: 'topRight',--}}
{{--                    });--}}
{{--                    $('.subscribe-email').val('');--}}

{{--                },--}}
{{--                error: (error) => {--}}
{{--                    if (typeof(error.responseJSON.errors.email) !== "undefined") {--}}
{{--                        iziToast.error({--}}
{{--                            message: error.responseJSON.errors.email,--}}
{{--                            position: 'topRight',--}}
{{--                        });--}}
{{--                    }--}}

{{--                }--}}
{{--            })--}}

{{--        });--}}

{{--        var url = "{{ route('user.changeLang') }}";--}}

{{--        $(".changeLang").change(function() {--}}
{{--            if ($(this).val() == '') {--}}
{{--                return false;--}}
{{--            }--}}
{{--            window.location.href = url + "?lang=" + $(this).val();--}}
{{--        });--}}
{{--        //Get the button--}}
{{--        let mybutton = document.getElementById("btn-back-to-top");--}}

{{--        // When the user scrolls down 20px from the top of the document, show the button--}}
{{--        window.onscroll = function() {--}}
{{--            scrollFunction();--}}
{{--        };--}}

{{--        function scrollFunction() {--}}
{{--            if (--}}
{{--                document.body.scrollTop > 20 ||--}}
{{--                document.documentElement.scrollTop > 20--}}
{{--            ) {--}}
{{--                mybutton.style.display = "block";--}}
{{--            } else {--}}
{{--                mybutton.style.display = "none";--}}
{{--            }--}}
{{--        }--}}
{{--        // When the user clicks on the button, scroll to the top of the document--}}
{{--        mybutton.addEventListener("click", backToTop);--}}

{{--        function backToTop() {--}}
{{--            document.body.scrollTop = 0;--}}
{{--            document.documentElement.scrollTop = 0;--}}
{{--        }--}}
{{--    </script>--}}


</body>


</html>
