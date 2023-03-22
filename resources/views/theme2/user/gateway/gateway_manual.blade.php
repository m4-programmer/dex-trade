
@extends(template() . 'layout.master2')

@section('content2')
    <div class="dashboard-body-part">
        <div class="row gy-4">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('Payment Information') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item text-light d-flex justify-content-between">
                                <span>{{ __('Method Currency') }}</span>
                                <span>{{ $general->site_currency}}</span>
                            </li>
                            <li class="list-group-item text-light">
                                <span class="w-100">
                                    <p><b>{{ ($gateway->wallet_address) }}</b><br></p>
                                    <p><br></p>
                                    <p>COPY and make PAYMENT to the wallet address above ⬆ or scan the barcode below </p>
                                    <p>WARNING: Make the payment before you click on "Deposit Now"<br></p>
                                    <p>Your deposit will take 3 minutes or more kindly exercise some patience<br></p>
                                </span>


                                <span class="w-100">
                                    <img src="{{ asset($gateway->qr_code) }}"
                                        alt="">
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('Payment Information') }}</h4>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item  text-light d-flex justify-content-between">
                                <span>{{ __('Gateway Name') }}:</span>

                                <span>{{ str_replace('_', ' ', $gateway->cryptocurrency) }}</span>

                            </li>
                            <li class="list-group-item  text-light d-flex justify-content-between">
                                <span>{{ __('Amount') }}:</span>
                                <span>{{ number_format($amount, 2) . ' ' . @$general->site_currency }}</span>
                            </li>

                            <li class="list-group-item  text-light d-flex justify-content-between">
                                <span>{{ __('Charge') }}:</span>
                                <span>{{ number_format(0, 2) . ' ' . @$general->site_currency }}</span>
                            </li>

                            <li class="list-group-item  text-light d-flex justify-content-between">
                                <span>{{ __('Conversion Rate') }}:</span>
                                <span>{{ '1 ' . @$general->site_currency . ' = ' . 1 }}</span>
                            </li>

                            <li class="list-group-item  text-light d-flex justify-content-between">
                                <span>{{ __('Total Payable Amount') }}:</span>
                                <span>{{ number_format($amount, 2). ' ' . @@$general->site_currency }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('Requirments') }}</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{route('deposit.complete')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for=""
                                        class="mb-2 mt-2">Upload Payment Proof (Screenshot)</label>
                                    <input type="file"
                                        name="proof"
                                        class="form-control" required>

                                </div>
                                <input type="text" name="amount" hidden value="{{$amount}}">
                                <input type="text" name="payment_method" hidden value="{{$gateway->cryptocurrency}}">
                                @if(isset($type) and $type == 'Investment')
                                <input type="text" name="type" value="Investment" hidden>
                                <input type="text" name="plan_id" value="{{$plan_id->id}}" hidden>
                                @endif


                                <div class="form-group">
                                    <button class="cmn-btn mt-4" type="submit">{{ __('Deposit Now') }}</button>

                                </div>


                            </div>



                        </form>



                    </div>

                </div>




            </div>
        </div>
    </div>
@endsection
