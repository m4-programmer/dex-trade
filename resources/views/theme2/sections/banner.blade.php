

<section id="banner" class="banner-section">
    <div class="globe-el">
        <img src="{{ asset('asset/theme2/images/bg/globe2.png') }}" alt="globe elements">
    </div>
    <div class="banner-candle">
        <img src="{{ asset('asset/theme2/images/bg/banner-candle.png') }}" alt="globe elements">
    </div>

    <div class="container">
        <div class="row gy-5 align-items-center justify-content-between">
            <div class="col-xxl-6 col-xl-7 wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="0.5s">
                <div class="banner-content text-lg-start text-center">
                    <h2 class="banner-title"> Get To The Next Level Investing</h2>
                    <div class="banner-btn-group justify-content-lg-start justify-content-center mt-4">
                        <a href="{{route('register') }}"
                            class="cmn-btn">Get Started</a>
                        <a href="{{route('about') }}"
                            class="border-btn">Know More</a>
                    </div>
                    <h5 class="mt-5">Trusted by more than 30,000+ users</h5>
                    <div class="row mt-4 overview-wrapper">
                        
                            <div class="col-lg-3 col-4">
                                <div class="overview-box">
                                    <div class="overview-box-amount">20K</div>
                                    <p>Total Investors</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-4">
                            <div class="overview-box">
                                    <div class="overview-box-amount">$100M</div>
                                    <p>Total Deposit</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-4">
                                <div class="overview-box">
                                    <div class="overview-box-amount">$55M</div>
                                    <p>Total Withdraw</p>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-5 d-xl-block d-none wow fadeInUp" data-wow-delay="0.7s"
                data-wow-duration="0.5s">
                <div class="banner-thumb">
                    <img src="{{ asset('asset/theme2/images/banner/63046d423eacf1661234498.png') }}" alt="banner image">
                </div>
            </div>
        </div>
    </div>
</section>



<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
    <div class="tradingview-widget-container__widget"></div>
    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/" rel="noopener"
            target="_blank"><span class="blue-text">Markets today</span></a> by TradingView</div>
    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
            "symbols": [{
                    "proName": "FOREXCOM:SPXUSD",
                    "title": "S&P 500"
                },
                {
                    "proName": "FOREXCOM:NSXUSD",
                    "title": "US 100"
                },
                {
                    "proName": "FX_IDC:EURUSD",
                    "title": "EUR/USD"
                },
                {
                    "proName": "BITSTAMP:BTCUSD",
                    "title": "Bitcoin"
                },
                {
                    "proName": "BITSTAMP:ETHUSD",
                    "title": "Ethereum"
                }
            ],
            "showSymbolLogo": true,
            "colorTheme": "dark",
            "isTransparent": false,
            "displayMode": "adaptive",
            "locale": "en"
        }
    </script>
</div>
<!-- TradingView Widget END -->




@push('style')
    <style>
        .tradingview-widget-container {
            height: 46px !important;
        }


        .tradingview-widget-copyright {
            display: none;
        }
    </style>
@endpush
