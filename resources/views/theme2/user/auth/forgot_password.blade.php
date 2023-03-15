<?php
function template(){return 'theme2.';}

?>
@extends(template().'layout.auth')

@section('content')
    @push('seo')
        <meta name='description' content="{{ @$gs->seo_description }}">
    @endpush

    <section class="auth-section">
        <div class="auth-wrapper">
            <div class="auth-top-part">
                <a href="{{ url('/') }}" class="auth-logo w-100 text-center">
                    <div style="width: 200px; ">
                        <svg viewBox="0 0 134 32" fill="none" xmlns="http://www.w3.org/2000/svg" data-v-548022aa=""><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7704 1.16329L11.5566 7.81411L10.3246 13.6477L17.1006 8.63871L27.0081 17.7879L15.7704 1.16329ZM30.2623 20.9562L23.0298 4.00032L20.2321 6.34897L30.2623 20.9562Z" fill="#EAECEF" data-v-548022aa=""></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M31.1215 25.9284L27.4868 18.9463L23.0669 14.9607L24.0019 23.349L11.1469 27.3788L31.1215 25.9284ZM25.0425 30.8171L24.4142 27.2119L6.79077 28.6206L25.0425 30.8171Z" fill="#EAECEF" data-v-548022aa=""></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5619 25.3688L7.85089 21.987L10.7984 8.8056L2.06394 26.8806L9.90994 27.2144L15.5619 25.3688ZM11.9052 4.3979L0.883484 19.1573L4.31197 20.4139L11.9052 4.3979ZM24.0043 23.349L11.1493 27.3788L31.1214 25.9259L24.0043 23.349Z" fill="#EAECEF" data-v-548022aa=""></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.85085 21.987L10.7983 8.80805L2.0639 26.8806L7.85085 21.987ZM17.1006 8.63871L27.0082 17.7879L15.7705 1.16329L17.1006 8.63871Z" fill="#EAECEF" data-v-548022aa=""></path> <path d="M45.264 21H41.056V10.328H45.264C46.9387 10.328 48.2987 10.8187 49.344 11.8C50.4 12.7813 50.928 14.072 50.928 15.672C50.928 17.272 50.4053 18.5627 49.36 19.544C48.3147 20.5147 46.9493 21 45.264 21ZM45.264 19C46.288 19 47.0987 18.68 47.696 18.04C48.304 17.4 48.608 16.6107 48.608 15.672C48.608 14.6907 48.3147 13.8907 47.728 13.272C47.1413 12.6427 46.32 12.328 45.264 12.328H43.328V19H45.264ZM60.8924 21H53.3404V10.328H60.8924V12.328H55.6124V14.584H60.7804V16.584H55.6124V19H60.8924V21ZM73.1485 21H70.4285L67.7565 17.096L65.0685 21H62.3645L66.2365 15.528L62.6045 10.328H65.3085L67.7565 13.976L70.1725 10.328H72.9085L69.2765 15.512L73.1485 21ZM77.4856 17.992H73.6456V16.264H77.4856V17.992ZM84.5705 21H82.2825V12.328H79.1625V10.328H87.6745V12.328H84.5705V21ZM98.571 21H95.963L93.867 17.208H92.203V21H89.931V10.328H94.923C96.0217 10.328 96.891 10.648 97.531 11.288C98.1817 11.928 98.507 12.7547 98.507 13.768C98.507 14.6427 98.2777 15.352 97.819 15.896C97.371 16.44 96.8217 16.7867 96.171 16.936L98.571 21ZM94.587 15.208C95.0563 15.208 95.4403 15.08 95.739 14.824C96.0377 14.5573 96.187 14.2053 96.187 13.768C96.187 13.3307 96.0377 12.984 95.739 12.728C95.4403 12.4613 95.0563 12.328 94.587 12.328H92.203V15.208H94.587ZM110.964 21H108.372L107.716 19.192H103.14L102.468 21H99.8762L104.004 10.328H106.852L110.964 21ZM107.092 17.192L105.428 12.6L103.764 17.192H107.092ZM116.958 21H112.75V10.328H116.958C118.632 10.328 119.992 10.8187 121.038 11.8C122.094 12.7813 122.622 14.072 122.622 15.672C122.622 17.272 122.099 18.5627 121.054 19.544C120.008 20.5147 118.643 21 116.958 21ZM116.958 19C117.982 19 118.792 18.68 119.39 18.04C119.998 17.4 120.302 16.6107 120.302 15.672C120.302 14.6907 120.008 13.8907 119.422 13.272C118.835 12.6427 118.014 12.328 116.958 12.328H115.022V19H116.958ZM132.586 21H125.034V10.328H132.586V12.328H127.306V14.584H132.474V16.584H127.306V19H132.586V21Z" fill="#F8FAFD" data-v-548022aa=""></path></svg>
                    </div>
                </a>
            </div>
            <div class="auth-body-part">
                <div class="auth-form-wrapper">
                    <h3 class="text-center mb-4">{{ __('Request For Reset Password') }}</h3>
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>{{ __('Email Address') }} <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email"
                            placeholder="{{ __('Enter Email') }}">
                        </div>
                        @if (@$gs->allow_recaptcha==1)
                            <div class="mb-3">
                                <script src="https://www.google.com/recaptcha/api.js"></script>
                                <div class="g-recaptcha" data-sitekey="{{ @$gs->recaptcha_key }}"
                                    data-callback="verifyCaptcha"></div>
                                <div id="g-recaptcha-error"></div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <button type="submit" id="recaptcha" class="cmn-btn w-100">{{ __('Send Verification Code') }}</button>
                        </div>
                        <div>
                            <p class="text-center">{{ __('Login Again') }}? <a href="{{ route('login') }}" class="color-change" >{{ __('Login') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="auth-footer-part">
                <p class="text-center mb-0">
                    @if (@$gs->copyright)
                        {{ __(@$gs->copyright) }}
                    @endif
                </p>
            </div>
        </div>
        <div class="auth-thumb-area">
            <div class="auth-thumb">
                <img src="{{ asset('asset/theme2/images/frontendlogin/frontend_login_image.png') }}" alt="image">
            </div>
        </div>
    </section>

@endsection


@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    "<span class='text-danger'>{{__('Captcha field is required.')</span>";
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
