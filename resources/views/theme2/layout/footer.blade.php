

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
                        <p>{{translate($gs->sitename.'  is a real investment platform. '. $gs->sitename.' leading team has over 7 years of experience in trading, cryptocurrencies and software development for Networkers.')}}</p>
                        <div class="footer-payment">
                            <h5>{{ translate('Payment Methods') }}</h5>
                            <img src="{{ asset('asset/theme2/images/gateways/BTC.png')}}" style="height: 50px;border-radius: 50%" alt="Payment Image">
                            <img src="{{ asset('asset/theme2/images/gateways/ETH.jpg')}}" style="height: 50px;border-radius: 50%" alt="Payment Image">
                            <img src="{{ asset('asset/theme2/images/gateways/BNB.jpg')}}" style="height: 50px;border-radius: 50%" alt="Payment Image">
                            <img src="{{ asset('asset/theme2/images/gateways/SOL.jpg')}}" style="height: 50px;border-radius: 50%" alt="Payment Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-box">
                        <h4 class="title">{{ translate('Useful Links') }}</h4>
                        <ul class="footer-link-list">
                            <li> <a href="{{ url('/') }}">{{ translate('HOME') }}</a></li>
                            <li> <a href="{{ url('/about') }}">{{ translate('ABOUT US') }}</a></li>
                            <li> <a href="{{ url('/faq') }}">{{ translate('FAQ') }}</a></li>
                            <li> <a href="{{ url('/terms') }}">{{ translate('TERMS') }}</a></li>
                            <li> <a href="{{ url('/contact') }}">{{ translate('CONTACT US') }}</a></li>

                        </ul>
                    </div>
                </div>
               <!--  <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-box">
                        <h4 class="title">{{ translate('Our Services') }}</h4>
                        <ul class="footer-link-list">
                            {{--@foreach ($serviceElements as $serviceelement)
                                <li><a
                                        href="{{ route('service', $serviceelement->data->slug) }}">{{ translate(@$serviceelement->data->title) }}</a>
                                </li>
                            @endforeach--}}
                        </ul>
                    </div>
                </div> -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box">
                        <h4 class="title">{{ translate('Location') }}</h4>
                        <p>
                            {!! @$gs->site_address !!}<br>
                            <strong>{{ translate('Phone') }}:</strong> {{ trans($gs->site_phone) }}<br>
                            <strong>{{ translate('Email') }}:</strong> {{ translate($gs->site_email) }}<br>
                        </p>
                        <ul class="social-links">
                           {{-- @forelse ($footersociallink as $item)
                              <li>
                                  <a href="{{ translate(@$item->data->social_link) }}" target="_blank" class="twitter"><i class="{{ @$item->data->social_icon }}"></i></a>
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
                    {{ 'Copyright '. translate(@$gs->copyright) }} {{$gs->sitename}}  . {{translate('All rights reserved.')}}
                @endif

            </p>
        </div>
    </div>
</footer>
