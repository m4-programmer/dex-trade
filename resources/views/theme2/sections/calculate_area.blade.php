<!-- <div class="calculate-area"> -->
    <!-- <div class="calculator"><img src="{{ asset('asset/theme2/images/elements/budget.png') }}" alt="image"></div> -->
   <!--  <div class="shape-1"><img src="{{ asset('asset/theme2/images/elements/cal-1.png') }}" alt="image"></div>
    <div class="shape-2"><img src="{{ asset('asset/theme2/images/elements/cal-2.png') }}" alt="image"></div>
    <div class="shape-3"><img src="{{ asset('asset/theme2/images/elements/cal-3.png') }}" alt="image"></div>
    <div class="shape-4"><img src="{{ asset('asset/theme2/images/elements/cal-4.png') }}" alt="image"></div> -->

    <div class="container p-4">
        <div class="row gy-4 align-items-end">
           <div class="col-lg-4 col-md-6">
                <label class="mbl-h">{{ __('Amount') }}</label>
                <input type="text" class="form-control" name="amount" id="amount"
                    placeholder="{{ __('Enter amount') }}">
            </div>
            <div class="col-lg-5 col-md-6">
                <label class="mbl-h">{{ __('Investment Plan') }}</label> 
                <!-- To loop through the available plans later -->
                <select class="form-select" name="selectplan" id="plan">
                    <option selected disabled class="text-secondary">{{ __('Select a plan') }}</option>
                     @forelse ($plans as $item) 
                        <option value="{{-- $item->id --}}">{{$item->name }}</option>
                     @empty
                    @endforelse 
                </select>
            </div>
            <div class="col-lg-3">
                <a href="#" id="calculate-btn" class="cmn-btn w-100"> {{ __('Calculate Earning') }}</a>
            </div>
        </div>
    </div>
</div>