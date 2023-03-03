<?php
function template(){return 'theme2.';}

?>
@extends(template().'layout.auth')

@section('content')
    @push('seo')
        <meta name='description' content="{{ @$gs->seo_description }}">
    @endpush

    <section class="auth-section auth-section-two">
        <div class="auth-wrapper">
            <div class="auth-top-part">
                <a href="{{ url('/') }}" class="auth-logo">
                    <img class="img-fluid rounded sm-device-img text-align" src="{{ asset('asset/theme2/logo/logo.png') }}" width="100%" alt="pp">
                </a>
                <p class="mb-0"><span class="me-2">{{ __('Already registered?') }}</span> <a class="cmn-btn btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a></p>
            </div>
            <div class="auth-body-part">
                <div class="auth-form-wrapper">
                    <h3 class="text-center mb-4">{{ __('Create An Account') }}</h3>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-lg-12">
                                @if (isset(request()->reffer))
                                <label for="formGroupExampleInput">{{ __('Reffered By')}}</label>
                                <input type="text" class="form-control bg-dark"  value="{{ request()->reffer }}" name="reffered_by"  placeholder="{{ __('Reffered By')}}" readonly>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput">{{ __('First Name')}}</label>
                                <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" id="first_name" placeholder="{{ __('First Name')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput">{{ __('Last Name')}}</label>
                                <input type="text" class="form-control" name="lname" value="{{ old('lname') }}" id="last_name" placeholder="{{ __('Last name')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="username">{{ __('Username')}}</label>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="{{ __('User Name')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput">{{ __('Phone')}}</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="email" placeholder="{{ __('phone')}}">
                            </div>

                            <div class="col-md-12">
                                <label for="formGroupExampleInput">{{ __('Email')}}</label>
                                <input type="Email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="{{ __('Email')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput">{{ __('Pasword')}}</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('Password')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="formGroupExampleInput"> {{ __('Confirm Pasword')}}</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Password')}}">
                            </div>
                            <div class="col-md-6">
                                @if (@$gs->allow_recaptcha==1)
                                    <script src="https://www.google.com/recaptcha/api.js"></script>
                                    <div class="g-recaptcha" data-sitekey="{{ @$gs->recaptcha_key }}"
                                        data-callback="verifyCaptcha"></div>
                                    <div id="g-recaptcha-error"></div>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="check" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">{{ __('I agree to the') }} <a href="{{ route('terms') }}"  class="color-change">{{ __('Privacy policy') }}</a></label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="cmn-btn w-100" type="submit"> {{ __('Register')}} </button>
                            </div>
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
