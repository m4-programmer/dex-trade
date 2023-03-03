

<footer class="footer-section has-bg-img">
    <div class="footer-top">
        <div class="map-el">
            <img src="{{ asset('asset/theme2/images/footer/map.png')  }}" alt="">
        </div>
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="footer-box">
                        <a href="/">
                            <h1>
                               {{$gs->sitename}}
                            </h1>
                        </a>
                        <p>Dextrade  is a real investment platform. Dextrade leading team has over 7 years of experience in trading, cryptocurrencies and software development for Networkers.</p>
                        <div class="footer-payment">
                            <h5>{{ __('Payment Methods') }}</h5>
                            <img src="{{ asset('asset/theme2/images/footer/payment-method.png')}}" alt="Payment Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-box">
                        <h4 class="title">{{ __('Useful Links') }}</h4>
                        <ul class="footer-link-list">
                            <li> <a href="{{ url('/') }}">{{ __('HOME') }}</a></li>
                            <li> <a href="{{ url('/about') }}">{{ __('ABOUT US') }}</a></li>
                            <li> <a href="{{ url('/faq') }}">{{ __('FAQ') }}</a></li>
                            <li> <a href="{{ url('/terms') }}">{{ __('TERMS') }}</a></li>
                            <li> <a href="{{ url('/contact') }}">{{ __('CONTACT US') }}</a></li>
                
                        </ul>
                    </div>
                </div>
               <!--  <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-box">
                        <h4 class="title">{{ __('Our Services') }}</h4>
                        <ul class="footer-link-list">
                            {{--@foreach ($serviceElements as $serviceelement)
                                <li><a
                                        href="{{ route('service', $serviceelement->data->slug) }}">{{ __(@$serviceelement->data->title) }}</a>
                                </li>
                            @endforeach--}}
                        </ul>
                    </div>
                </div> -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <h4 class="title">{{ __('Location') }}</h4>
                        <p>
                            {{ @$gs->site_address }}<br>
                            <strong>{{ __('Phone') }}:</strong> {{ $gs->site_phone }}<br>
                            <strong>{{ __('Email') }}:</strong> {{ $gs->site_email }}<br>
                        </p>
                        <ul class="social-links">
                           {{-- @forelse ($footersociallink as $item)
                              <li>
                                  <a href="{{ __(@$item->data->social_link) }}" target="_blank" class="twitter"><i class="{{ @$item->data->social_icon }}"></i></a>
                              </li>
                          @empty
                          @endforelse--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="text-center mb-0">
                @if (@$gs->copyright)
                    Copyright {{ __(@$gs->copyright) }} {{$gs->sitename}}  . All rights reserved.
                @endif
                
            </p>
        </div>
    </div>
</footer>
