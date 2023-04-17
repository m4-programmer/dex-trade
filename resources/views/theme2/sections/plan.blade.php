
<section id="investment" class="s-pt-100 s-pb-100 section-bg">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-top">
                    <!-- <h2 class="section-title">Our Plans</h2> -->

                </div>
            </div>
        </div>

        <div class="row gy-4">
            @foreach ($plans as $plan)

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <div class="pricing-item">
                        <div class="top-part">
                            <div class="icon">
                                <i class="las la-gem"></i>
                            </div>
                            <div class="plan-name">
                                <span>{{ translate($plan->name) }}</span>
                            </div>

                                <h4 class="plan-price">
                                    {{ number_format($plan->minimum_amount, 2)}} <sub>/ {{ @$gs->site_currency }}</sub>
                                </h4>
                                <h4 class="plan-price">
                                    {{ translate("Max") }}
                                    @if($plan->maximum_amount != "Unlimited")
                                        {{ number_format($plan->maximum_amount, 2) }} <sub>/ {{ @$gs->site_currency }}</sub>
                                    @else
                                        {{translate($plan->maximum_amount)}}
                                    @endif
                                </h4>


                            <ul class="check-list">

                                <li>{{ translate("Return Amount ") }}{{ number_format($plan->roi, 2) }}

                                        {{ "%" }}

                                </li>
                                <li>
                                  {{translate($plan->duration)}}
                                </li>

                                <li>{{ translate("Capital Back") }} {{$plan->capital_back}}</li>



                            </ul>
                        </div>
                        <div class="bottom-part">


                                <a class="cmn-btn w-100 "
                                    href="{{ route("investment.create","id=". $plan->id) }}">{{ translate("Choose Plan") }}</a>

                                  @auth

                                    <button class="cmn-btn w-100 balance mt-3" data-plan="{{ $plan }}"
                                        data-url="">{{ translate("Invest Using Balance") }}</button>
                                    @endauth


                        </div>
                    </div><!-- pricing-item end -->
                </div>

            @endforeach
        </div>
    </div>
</section>

<!-- Profit Calculator -->
<div class="modal fade" id="invest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route("investmentUsingBalannce")}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{translate("Invest Now")}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="">{{ translate("Invest Amount") }}</label>
                            <input type="text" name="amount" class="form-control">
                            <input type="hidden" name="plan_id" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translate("Close")}}</button>
                    <button type="submit" class="btn cmn-btn">{{translate("Invest Now")}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push("script")
    <script>
        $(function() {
            "use strict"

            $(".balance").on("click", function() {
                const modal = $("#invest");
                modal.find("input[name=plan_id]").val($(this).data("plan").id);
                modal.modal("show")
            })
        })
    </script>
@endpush
