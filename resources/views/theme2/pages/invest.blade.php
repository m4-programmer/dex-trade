<?php
function template(){return 'theme2.';}

?>
@extends(template().'layout.master2')
<?php 
    
 ?>
@section('content2')

    <div class="dashboard-body-part">
        <div class="row gy-4">
            @forelse ($plans as $plan)
             
                <?php $plan_exist = 3; ?>
               <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <div class="pricing-item">
                        <div class="top-part">
                            <div class="icon">
                                <i class="las la-gem"></i>
                            </div>
                            <div class="plan-name">
                                <span>{{ $plan->name }}</span>
                            </div>
                           
                                <h4 class="plan-price">
                                    {{ __('Min') }}
                                    {{ number_format($plan->minimum_amount, 2)}} <sub>/ {{ @$gs->site_currency }}</sub>
                                </h4>
                                <h4 class="plan-price">
                                    {{ __('Max') }}
                                    @if($plan->maximum_amount != 'Unlimited')
                                        {{ number_format($plan->maximum_amount, 2) }} <sub>/ {{ @$gs->site_currency }}</sub>
                                    @else
                                        {{$plan->maximum_amount}}
                                    @endif
                                </h4>
                            
                            
                            <ul class="check-list">
                                
                                <li>{{ __('Return Amount: ') }}{{ $plan->roi }}
                                    
                                        {{ '%' }}
                                   
                                </li>
                                <li>
                                  {{$plan->duration}}
                                </li>
                               
                                <li>{{ __('Capital Back:') }} {{$plan->capital_back}}</li>
                               


                            </ul>
                        </div>
                        <div class="bottom-part">
                            
                            
                                <a class="cmn-btn w-100 "
                                    href="{{ route('investment.create','id='. $plan->id) }}">{{ __('Choose Plan') }}</a>
                                    
                                  @auth
                                        
                                    <button class="cmn-btn w-100 balance mt-3" data-plan="{{ $plan }}"
                                        data-url="">{{ __('Invest Using Balance') }}</button>
                                    @endauth 
                            
                            
                        </div>
                    </div><!-- pricing-item end -->
                </div>

            @empty
            @endforelse
        </div>
    </div>


    <div class="modal fade" id="invest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('investmentUsingBalannce')}}" method="post">
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

