
@extends(template().'layout.auth')

@section('content')

    @push('seo')
        <meta name='description' content="{{ @$general->seo_description }}">
    @endpush

    <section class="auth-section">
        <div class="auth-wrapper">
            <div class="auth-top-part">
                <a href="{{ route('home') }}" class="auth-logo w-100 text-center">
                    <img class="img-fluid rounded sm-device-img text-align" src="{{ getFile('logo', @$general->logo) }}" width="100%" alt="logo">
                </a>
            </div>
            <div class="auth-body-part">
                <div class="auth-form-wrapper">
                    <h3 class="text-center mb-4">{{ __('Request For Reset Password') }}</h3>
                    <form action="{{ route('user.auth.verify') }}" method="POST">
                        @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-3">
                                <label>{{ __('Verify Code') }}</label>
                                <input type="code" class="form-control" name="code"
                                placeholder="{{ __('Enter Code Here') }}">
                            </div>
                            @if (@$general->allow_recaptcha==1)
                                <div class="mb-3">
                                    <script src="https://www.google.com/recaptcha/api.js"></script>
                                    <div class="g-recaptcha" data-sitekey="{{ @$general->recaptcha_key }}"
                                        data-callback="verifyCaptcha"></div>
                                    <div id="g-recaptcha-error"></div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <button type="submit" class="cmn-btn w-100">{{ __('Verify Now') }}</button>
                            </div>
                            <div class="text-center">
                                <p>{{ __('Login Again') }}? <a href="{{ route('user.login') }}" class="color-change"  >{{ __('Login') }}</a></p>
                            </div>
                    </form>
                </div>
            </div>
            <div class="auth-footer-part">
                <p class="text-center mb-0">
                    @if (@$general->copyright)
                        {{ __(@$general->copyright) }}
                    @endif
                </p>
            </div>
        </div>
        <div class="auth-thumb-area">
            <div class="auth-thumb">
                <img src="{{ getFile('frontendlogin', @$general->frontend_login_image) }}" alt="image">
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
