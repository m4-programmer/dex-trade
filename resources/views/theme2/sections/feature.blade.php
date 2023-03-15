


<?php 
$items = [
    [
        'card_title' => 'REGISTERED COMPANY',
        'card_description' => 'Registered and Certified',
    ],
      [
        'card_title' => 'Verified Security',
        'card_description' => 'All investment are secured, we have all it take since 2017 and still more.',
    ],
      [
        'card_title' => 'Secured Investment',
        'card_description' => 'All investment are secured, we have all it take.',
    ],
    [
        'card_title' => 'Instant Withdrawal',
        'card_description' => 'We are active 24 hours, your withdrawal is process immediately as requested. ',
    ],
    [
        'card_title' => '24/7 LIVE SUPPORT',
        'card_description' => 'We are at your service all time, you are welcome.',
    ],
    [
        'card_title' => 'EXPERIENCED Management Team',
        'card_description' => 'Well trained and certified team with experience in cryptocurrency field, we keep to date on a daily.',
    ],
];

$elements = json_decode(json_encode($items));
// dd($elements);

 ?>

<!-- why choose section start -->
<section id="why-choose" class="choose-section s-pt-100 s-pb-100">
    <div class="choose-el">
        <img src="{{ asset('asset/theme2/images/bg/choose-el.png') }}" alt="image">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
            <div class="section-top text-center">
                <h2 class="section-title">Why Choose Us</h2>
            </div>
            </div>
        </div><!-- row end -->
        <div class="choose-wrapper">

            <div class="choose-wrapper-thumb">
                <div class="thumb-inner">
                    <i class="fab fa-btc"></i>
                </div>
                <div class="left-1"></div>
                <div class="left-2"></div>
                <div class="right-1"></div>
                <div class="right-2"></div>
            </div>

            <div class="choose-wrapper-inner">
                @foreach ($elements as $element)
                    <div class="choose-item  wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="0.5s">
                        <div class="icon">
                            <i class="{{ @$element->card_icon }}"></i>
                        </div>
                        <div class="content">
                            <h4 class="title" style="text-transform: uppercase;">{{ __(@$element->card_title) }}</h4>
                            <p class="mt-2 mb-0">{{ __(@$element->card_description) }}</p>
                        </div>
                    </div><!-- choose-item end -->
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- why choose section end -->