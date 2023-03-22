<table id="profit-table" class="table w-100" >
    <tr>
        <td>{{ __('Plan') }}</td>
        <td>{{ __($plan->plan_name) }}</td>
    </tr>
    <tr>
        <td>{{ __('Amount') }}</td>
        <td>{{ $amount . ' ' . @$general->site_currency }}</td>
    </tr>
    <tr>
        <td>{{ __('Payout Period') }}</td>
        <td>
            {{$plan->duration}}

        </td>
    </tr>
    <tr>
        <td>{{ __('Profit') }}</td>
        <td>{{ $calculate . ' ' . @$general->site_currency }}</td>
    </tr>
    <tr>
        <td>{{ __('Capital back') }}</td>
        <td>
           
                {{ __('Capital Back') }} <span style="text-transform: capitalize;">{{ $plan->capital_back }}</span>
           
        </td>
    </tr>
    <tr>
        <td>{{ __('Total Payout') }}</td>
        <td>
            @if ($plan->return_for == 1)
                {{ __($calculate * $plan->how_many_time) }} + {{ __($plan->capital_back == 1 ? $amount : '0') }}
                {{ @$general->site_currency }}
            @else
                {{ __($calculate + $amount) }} {{ @$general->site_currency }}
            @endif

        </td>


    </tr>
</table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <a href="{{ route('investment.create','id='. $plan->id ) }}" type="button" class="btn cmn-btn">{{ __('Invest') }}</a>
</div>
