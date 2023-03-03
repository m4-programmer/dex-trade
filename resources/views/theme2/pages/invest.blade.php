<?php
function template(){return 'theme2.';}

?>
@extends(template().'layout.master2')
<?php 
    $plans = items();
 ?>
@section('content2')

    <div class="dashboard-body-part">
        <div class="row gy-4">
            @forelse ($plans as $plan)
                {{-- @php
                    $plan_exist = App\Models\Payment::where('plan_id', $plan->id)
                        ->where('user_id', Auth::id())
                        ->where('next_payment_date', '!=', null)
                        ->where('payment_status', 1)
                        ->count();

                @endphp --}}
                <?php $plan_exist = 3; ?>
                <div class="col-xxl-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <div class="pricing-item">
                        <div class="top-part">
                            <div class="icon">
                                <i class="las la-gem"></i>
                            </div>
                            <div class="plan-name">
                                <span>{{ $plan->plan_name }}</span>
                            </div>
                            @if ($plan->amount_type == 0)
                                <h4 class="plan-price">
                                    {{ __('Min') }}
                                    {{ number_format($plan->minimum_amount, 2)}} <sub>/ {{ @$gs->site_currency }}</sub>
                                </h4>
                                <h4 class="plan-price">
                                    {{ __('Max') }}
                                    {{ number_format($plan->maximum_amount, 2) }} <sub>/ {{ @$gs->site_currency }}</sub>
                                </h4>
                            @else
                                <h4 class="plan-price">
                                    {{ number_format($plan->amount, 2) }} <sub>/ {{ @$gs->site_currency }}</sub>
                                </h4>
                            @endif

                            <ul class="check-list">
                                <li>{{ __('Every') }} {{ $plan->time->name }}</li>
                                <li>{{ __('Return Amount ') }}{{ number_format($plan->return_interest, 2) }}
                                    @if ($plan->interest_status == 'percentage')
                                        {{ '%' }}
                                    @else
                                        {{ @$gs->site_currency }}
                                    @endif
                                </li>
                                <li>
                                    @if ($plan->return_for == 1)
                                        {{ __('For') }} {{ $plan->how_many_time }}
                                        {{ __('Times') }}
                                    @else
                                        {{ __('Lifetime') }}
                                    @endif
                                </li>
                                @if ($plan->capital_back == 1)
                                    <li>{{ __('Capital Back') }} {{ __('YES') }}</li>
                                @else
                                    <li>{{ __('Capital Back') }} {{ __('NO') }}</li>
                                @endif


                            </ul>
                        </div>
                        <div class="bottom-part">

                            @if ($plan_exist >= $plan->invest_limit)
                            <a class="cmn-btn w-100" href="#">{{ __('Max Invest Limit exceeded') }}</a>
                            @else
                                <a class="cmn-btn w-100 mb-3"
                                    href="{{ route('user.gateways', $plan->id) }}">{{ __('Invest Now') }}</a>


                                <button class="cmn-btn w-100 balance" data-plan="{{ $plan }}"
                                    data-url="">{{ __('Invest Using Balance') }}</button>
                            @endif

                        </div>
                    </div>
                </div>

            @empty
            @endforelse
        </div>
    </div>


    <div class="modal fade" id="invest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{url('user.investmentplan.submit')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Invest Now')}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="">{{ __('Invest Amount') }}</label>
                                <input type="text" name="amount" class="form-control">
                                <input type="hidden" name="plan_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn cmn-btn">{{__('Invest Now')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.balance').on('click', function() {
                const modal = $('#invest');
                modal.find('input[name=plan_id]').val($(this).data('plan').id);
                modal.modal('show')
            })
        })
    </script>
@endpush
<?php 
 function items()
{
    $items = [
    [
        'id' => 1,
        'plan_name' => 'Basic Plan',
        'amount_type' => 0,
        'minimum_amount' => 3000,
        'maximum_amount' => 6000,
        'amount' => 4500,
        'time' => ['name' => 'test'],
        'return_interest' => 3400,
        'interest_status' => 'percentage',
        'return_for' => 0,
        'capital_back' => 1,
        'invest_limit' => 2,
        'plan_exist' => 1,


    ],
    [
        'id' => 2,
        'plan_name' => 'Business Plan',
        'amount_type' => 0,
        'minimum_amount' => 3000,
        'maximum_amount' => 6000,
        'amount' => 4500,
        'time' => ['name' => 'test'],
        'return_interest' => 3400,
        'interest_status' => 'percentage',
        'return_for' => 0,
        'capital_back' => 1,
        'invest_limit' => 2,
        'plan_exist' => 1,

    ],
    [
        'id' => 3,
        'plan_name' => 'Premium Plan',
        'amount_type' => 0,
        'minimum_amount' => 3000,
        'maximum_amount' => 6000,
        'amount' => 4500,
        'time' => ['name' => 'test'],
        'return_interest' => 3400,
        'interest_status' => 'percentage',
        'return_for' => 0,
        'capital_back' => 1,
        'invest_limit' => 2,
        'plan_exist' => 1,

    ],
];
return $plans = json_decode(json_encode($items));
}
 ?>