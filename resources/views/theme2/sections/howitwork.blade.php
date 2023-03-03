@php
$items  = [
    [
        'title' => 'Create account',
        'description'=> 'By Registering on the website you will able to start your operation',
    ],
     [
        'title' => 'Verify email',
        'description'=> 'After creating an account, user needs to verify their account using their email',
    ],
     [
        'title' => 'Verify kyc',
        'description'=> 'Users\' needs KYC verification before making any withdrawals',
    ],
    [
        'title' => 'Deposit money',
        'description'=> 'Users can deposit using manual gateways that have been made available',
    ],
     [
        'title' => 'Investment plan',
        'description'=> 'Users can invest in any plan and enjoy the profit which will add to the profit wallet',
    ],
    [
        'title' => 'Refer to friends',
        'description'=> 'You can generate income from referring us to friends',
    ],
    [
        'title' => 'Withdraw and enjoy',
        'description'=> 'Withdrawal can be performed in the main wallet and it will take a little time to complete',
    ],
];

$elements = json_decode(json_encode($items))
@endphp

<section id="how-start" class="s-pt-100 s-pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-top">
                    <h2 class="section-title">How it Works</h2>
                </div>
            </div>
        </div>

        <div class="row gy-5 work-wrapper">
            @foreach ($elements as $element)
                <div class="col-lg-4">
                    <div class="work-box">
                        <div class="icon">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">{{ __(@$element->title) }}</h3>
                            <p>{{$element->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
