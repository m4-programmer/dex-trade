<?php
use App\Models\GeneralSettings as GS;
$general = GS::get()->first();
?>
@extends('backend.layout.master')


@section('content')

    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__($pageTitle)}}</h1>
          </div>

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
               
                <div class="card-body text-center">
                    <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">

                        <span>{{__('Transaction Id')}}</span>
                        <span>{{$manual->transaction_id}}</span>
                    
                    </li> 
                    
                    <li class="list-group-item d-flex justify-content-between">

                        <span>{{__('Payment Date')}}</span>
                        <span>{{$manual->created_at->format('d F Y')}}</span>
                    
                    </li>
                @if(!isset($payment_type))
                        <li class="list-group-item d-flex justify-content-between">

                            <span>Amount: {{$manual->amount}} {{$general->site_currency}}</span>
                            <span class="text-right"><img src="{{asset( $manual->proof)}}" alt="" class="w-50 "></span>
                        
                        </li>
                    @endif
                    @if(isset($payment_type))
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Payer Name')}}</span>
                            <span>{{$manual->user->name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Amount Paid')}}</span>
                            <span>{{number_format($manual->amount,2)}} {{$general->site_currency}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('ROI')}}</span>
                            <span>{{$manual->roi}}%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Amount To Recieve: ')}} <small> <?php echo $manual->amount ."+ (". $manual->amount ."* (".     $manual->roi ."/100)" ?></small></span>
                            <?php $profit =  $manual->amount * ($manual->roi/100);  ?>
                            <span>{{ number_format(($manual->amount + $profit), 2)}} {{$general->site_currency}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Payment Method')}}</span>
                            <span>{{$manual->gateway}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Plan ')}}</span>
                            <span>{{$manual->plan_name}}</span>
                        </li>
                         <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Plan Duration')}}</span>
                            <span>{{$manual->duration}}</span>
                        </li>
                         <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('Investment Status')}}</span>
                             @if ($manual->status == 'pending')
                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                            @elseif($manual->status == "active")
                                <span class="badge badge-success">{{ __('Active') }}</span>
                            @elseif($manual->status == "ended")
                                <span class="badge badge-danger">{{ __('Ended') }}</span>
                            @endif
                        </li>
                        
                    @endif
                   
                    
                    </ul>
                    @if(isset($payment_type))
                    @if ($manual->status == "pending")
                            <div class="p-3">
                                <a class="btn text-white btn-md btn-primary"
                                href="{{ route('admin.investment.accept', $manual->transaction_id) }}" title="Accept">{{ __('Accept') }}</a>

                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>




@endsection