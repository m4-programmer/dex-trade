
@extends(template().'layout.master')

@section('content')
    <section class="breadcrumbs" style="background-image: url({{ asset('asset/theme2/images/breadcrumbs/breadcrumbs.png') }});">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center text-capitalize">
                <h2>{{ translate("FAQ") }}</h2>
                <ol>
                    <li><a href="{{ route('home') }}">{{ translate('Home') }}</a></li>
                    <li>{{ translate('Faq') }}</li>
                </ol>
            </div>

        </div>
    </section>

   <?php

$items = [
  [
    'question' => 'When can i Deposit/ withdraw from my investment account',
    'answer' => 'Deposit and withdrawal are available at any time. Be sure, that your funds are not used in any ongoing trade before the withdrawal. The available amount is shown in your dashboard on the main page of Investing platform.',
  ],
];

$elements = json_decode(json_encode($items));
 ?>

<!-- faq section start -->
<section id="faq" class="faq-section section-bg s-pt-100 s-pb-100">
      <div class="faq-el">
        <img src="{{ asset('asset/theme2/images/faq/faq.png') }}" alt="image">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section-top text-center">
              <h2 class="section-title">{{translate('FAQ')}}</h2>
            </div>
          </div>
        </div><!-- row end -->
        <div class="row">
          <div class="col-lg-12">
            <div class="faq-wrapper wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                @foreach ($elements as $item)
                <div class="faq-single">
                    <div class="faq-single-header">
                    <h4 class="title">{{ translate(@$item->question) }}</h4>
                    </div>
                    <div class="faq-single-body">
                    <p>{{ translate(@$item->answer) }}</p>
                    </div>
                </div><!-- faq-single end -->
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- faq section end -->
@endsection
