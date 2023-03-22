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
                            <form method="POST" action="{{ route('admin.plan.store') }}">
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('Plan Name') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Plan name">
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
                                            <input type="number" class="form-control" name="minimum"
                                                value="{{ old('minimum') }}" placeholder="Minimum Amount">
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ @$general->site_currency }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group offman col-md-6" id="maximum">
                                        <label class="font-weight-bold">{{ __('Maximum Amount') }}</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="maximum"
                                                value="{{ old('maximum') }}" placeholder="Maximum Amount">
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
                                            <input type="number" value="{{old('Interest')}}" class="form-control" name="interest"
                                                placeholder="Interest rate">
                                            <div class="input-group-append">
                                                <div class="input-group-append">
                                                <div class="input-group-text">%</div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('Duration') }}</label>
                                        <input type="text" value="{{old('Duration')}}" class="form-control" name="Duration" placeholder="give space b/w the number and time type, e.g 24 hour or 1 Year">
                                    </div>



                                    <div class="form-group col-md-6">

                                        <label class="font-weight-bold">{{ __('Capital Back') }}</label>
                                        <select name="capital_back" class="form-control selectric">
                                            <option value="no">{{ __('No') }}</option>
                                            <option value="yes">{{ __('Yes') }}</option>
                                        </select>
                                    
                                    </div>

                                    

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">{{ __('Status') }}</label>
                                        <select name="status" class="form-control selectric">
                                            <option value="active" selected>{{ __('Active') }}</option>
                                            <option value="pending">{{ __('Pending') }}</option>
                                        </select>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Plan Create') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection



