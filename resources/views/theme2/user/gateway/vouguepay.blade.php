@extends(template().'layout.master2')

@section('content2')
<div class="dashboard-body-part">
    <div class="card">
        <div class="card-header text-center">
            <h4 class="mb-0">{{ __('Payment Preview') }}</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @if(!(session('type') == 'deposit'))
                <li class="list-group-item text-light  d-flex justify-content-between">
                    <span>{{ __('Plan Name') }}:</span>

                    <span>{{ $deposit->plan->plan_name }}</span>

                </li>
                @endif
                <li class="list-group-item  text-light d-flex justify-content-between">
                    <span>{{ __('Gateway Name') }}:</span>

                    <span>{{ $deposit->gateway->gateway_name }}</span>

                </li>
                <li class="list-group-item  text-light d-flex justify-content-between">
                    <span>{{ __('Amount') }}:</span>
                    <span>{{ number_format($deposit->amount, 2) }}</span>
                </li>

                <li class="list-group-item  text-light d-flex justify-content-between">
                    <span>{{ __('Charge') }}:</span>
                    <span>{{ number_format($deposit->charge, 2) }}</span>
                </li>


                <li class="list-group-item  text-light d-flex justify-content-between">
                    <span>{{ __('Conversion Rate') }}:</span>
                    <span>{{ '1 ' . @$general->site_currency . ' = ' . number_format($deposit->rate, 2) }}</span>
                </li>



                <li class="list-group-item d-flex  text-light justify-content-between">
                    <span>{{ __('Total Payable Amount') }}:</span>
                    <span>{{ number_format($deposit->final_amount, 2) }}</span>
                </li>
            </ul>
            <div class="text-end mt-3">
                <form method='POST' action='https://pay.voguepay.com'>
                    <input type="hidden" name='v_merchant_id' value="{{ $vouguePayParams->marchant_id }}" />
                    <input type="hidden" name='merchant_ref' value="{{ $vouguePayParams->merchant_ref }}" />
                    <input type="hidden" name='memo' value="{{ $vouguePayParams->memo }}" />
                    <input type="hidden" name='item_1' value='Plan Purchase' />
                    <input type="hidden" name='description_1' value='Payment' />
                    <input type="hidden" name='price_1' value='{{ $vouguePayParams->amount }}' />
                    <input type="hidden" name='cur' value="{{ $vouguePayParams->currency }}" />
                    <input type="hidden" name='developer_code' value='5a61be72ab323' />
                    <input type="hidden" name='total' value="{{ $vouguePayParams->amount }}" />
                    <input type="hidden" name='custom' value="{{ $deposit->transaction_id }}" />
                    <input type="hidden" name='name' value='Customer name'/>
                    <input type="hidden" name='address' value='Customer Address'/>
                    <input type="hidden" name='city' value='Customer City'/>
                    <input type="hidden" name='state' value='Customer State'/>
                    <input type="hidden" name='zipcode' value='Customer Zip/Post Code'/>
                    <input type="hidden" name='email' value='ajayishegs@gmail.com'/>
                    <input type="hidden" name='phone' value= 'Customer phone' />

                    <input type="hidden" name='success_url' value= "{{ route('user.vouguepay.redirect') }}"/>
                    <button type='submit' class="cmn-btn">{{__('Pay Via Voguepay')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

