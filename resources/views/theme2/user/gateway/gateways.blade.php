
@extends(template() . 'layout.master2')

@section('content2')
    <div class="dashboard-body-part">
        <div class="row gy-4 ">
            @forelse ($gateways as $gateway)
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="payment-box text-center">
                        <div class="payment-box-thumb">
                            <img src="{{ asset($gateway->image) }}" alt="{{$gateway->short_name}}" style="width: 100%;" class="trans-img">
                        </div>
                        <div class="payment-box-content">
                            <h4 class="title">{{ ucwords(str_replace('_', ' ', $gateway->cryptocurrency)) }}</h4>
                            @if(isset($type) && $type == 'deposit')
                            <button data-href="{{ route('deposit.paynow', $gateway->id) }}" data-id="{{ $gateway->id }}"
                                class="cmn-btn w-100 paynow mt-3">{{ __('Pay Now') }}</button>
                            @else
                            <button data-href="{{ route('investDetails', $gateway->id) }}" data-id="{{ $gateway->id }}"
                                class="cmn-btn w-100 paynow mt-3">{{ __('Invest Now') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{ __('Not Found') }}
            @endforelse

        </div>
    </div>

    @if (isset($type) && $type == 'deposit')
        <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    @csrf
                    <div class="modal-content bg-body">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Deposit Amount') }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-light">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" value="">
                                <div class="form-group">
                                    <label for="">{{ __('Amount') }}</label>
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="{{ __('Enter Amount') }}">

                                    <input type="hidden" name="user_id" class="form-control" value="{{ auth()->id() }}">
                                    <input type="hidden" name="type" class="form-control" value="deposit">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="cmn-btn">{{ __('Deposit Now') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    @csrf
                    <div class="modal-content bg-body">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Invest Amount') }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-light">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" value="">
                                <div class="form-group">
                                    <label for="">{{ __('Amount') }}</label>
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="{{ __($message) }}">

                                    <input type="text" name="plan_id" class="form-control" value="{{ $plan_id }}"
                                        hidden>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="cmn-btn">{{ __('Invest Now') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif


@endsection

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.paynow').on('click', function() {
                const modal = $('#paynow')

                modal.find('form').attr('action', $(this).data('href'))
                modal.find('input[name=id]').val($(this).data('id'))

                modal.modal('show')
            })
        })
    </script>
@endpush
