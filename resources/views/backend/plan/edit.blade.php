<?php
use App\Models\GeneralSettings as GS;
$general = GS::get()->first();
?>
@extends('backend.layout.master')


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
            </div>
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.plan.index') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left mr-2"></i>{{ __('Back') }}</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.plan.update', $plan->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('Plan Name') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $plan->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                <span />
                                            @enderror
                                    </div>

                                    <div class="form-group offman col-md-6" id="minimum">
                                        <label class="font-weight-bold">{{ __('Minimum Amount') }}<span
                                                class="text-danger">*</span></label></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="minimum" id="minimum_a"
                                                value="{{ $plan->minimum_amount ? $plan->minimum_amount : 0 }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ @$general->site_currency }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group offman col-md-6" id="maximum">
                                        <label class="font-weight-bold">{{ __('Maximum Amount') }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control maximum_a" name="maximum"
                                                id="maximum_a"
                                                value="{{ $plan->maximum_amount ? $plan->maximum_amount : 0 }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ @$general->site_currency }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('ROI') }}
                                            <span class="text-danger">*</span></label>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="interest"
                                                value="{{ $plan->roi ? $plan->roi : 0 }}">
                                            <div class="input-group-append">
                                                <div class="input-group">
                                                   <div class="input-group-append">
                                                        <div class="input-group-text">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                   

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('Duration') }}</label>
                                        <input type="text" value="{{$plan->duration}}" class="form-control" name="Duration" placeholder="give space b/w the number and time type, e.g 24 hour or 1 Year">
                                    </div>

                                    <div class="form-group col-md-6">
                                      <label class="font-weight-bold">{{ __('Capital Back') }}</label>
                                        <select name="capital_back" class="form-control selectric">

                                            <option {{ $plan->capital_back == 'no' ? 'selected' : '' }} value="no">
                                                {{ __('No') }}</option>

                                            <option {{ $plan->capital_back == 'yes' ? 'selected' : '' }} value="yes">
                                                {{ __('Yes') }}</option>
                                        </select>
                                    </div>

                                  

                                    


                                    
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('Status') }}</label>
                                        <select name="status" class="form-control selectric">
                                            <option {{ $plan->status == 'pending' ? 'selected' : '' }} value="pending">
                                                {{ __('Disable') }}</option>

                                            <option {{ $plan->status == 'active' ? 'selected' : '' }} value="active">
                                                {{ __('Active') }}</option>
                                        </select>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('script')
    <script>
        'use strict'


        $(function() {

            $('.how_many_times').hide();
            var amount_type = $('#amount_type').val();
            var return_period = $('#return_for').val();


            if (amount_type == 1) {
                $('#minimum').hide();
                $('#maximum').hide();

            }

            if (amount_type == 0) {
                $('#minimum').show();
                $('#maximum').show();
                $('.amount').hide();


            }

            if (return_period == 1) {
                $('.how_many_times').show();
                $('#capitalBack').show();

            } else {
                $('.how_many_times').hide();
                $('#capitalBack').hide();

            }


            $('#amount_type').on('change', function() {
                var value = $('#amount_type').val();

                if (value == 1) {
                    $('.amount').show();
                    $('#minimum').hide();
                    $('#maximum').hide();
                    $('#minimum_a').val('');
                    $('#maximum_a').val('');

                } else {
                    $('.amount').hide();
                    $('#minimum').show();
                    $('#maximum').show();
                    $('#amount').val('');

                }

            })

            $('#return_for').on('change', function() {

                var value = $('#return_for').val();

                if (value == 1) {
                    $('.how_many_times').show();
                    $('#capitalBack').show();

                } else {
                    $('.how_many_times').hide();
                    $('#capitalBack').hide();

                }

            })

        })
    </script>
@endpush
