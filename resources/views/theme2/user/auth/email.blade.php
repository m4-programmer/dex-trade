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
                <a href="{{ route('home') }}" class="auth-logo w-100 text-center">
                    <img class="img-fluid rounded sm-device-img text-align" src="{{ asset('asset/theme2/images/logo/frontend_login_image.png') }}" alt="image">" width="100%" alt="logo">
                </a>
            </div>
            <div class="auth-body-part">
                <div class="auth-form-wrapper">
                    <h3 class="text-center mb-4">{{ __('Request For Reset Password') }}</h3>
                    <form class="reg-form" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="formGroupExampleInput"> {{ __('Verification Code') }}</label>
                            <input type="text" name="code" class="form-control" placeholder="{{ __('Enter Verification Code') }}">
                        </div>
                        @if (@$gs->allow_recaptcha)
                            <div class="mb-3">
                                <script src="https://www.google.com/recaptcha/api.js"></script>
                                <div class="g-recaptcha" data-sitekey="{{ @$gs->recaptcha_key }}"
                                    data-callback="verifyCaptcha"></div>
                                <div id="g-recaptcha-error"></div>
                            </div>
                        @endif
                        <button class="cmn-btn w-100" type="submit"> {{ __('Verify Now') }} </button>
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
