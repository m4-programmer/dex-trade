@forelse(@$transactions as $transaction)
<tr>
    <td>{{ @$transaction->user->name }}</td>
    <td>{{ @$transaction->gateway }}</td>
    <td>{{ @$transaction->transaction_id }}</td>
    <td>{{ @number_format($transaction->amount,2) }}</td>
    <td>{{ @number_format($transaction->rate,2) }}</td>
    
    <td>{{ @number_format($transaction->amount,2) }}</td>
    <td>
         @if ($transaction->payment_type == 'deposits')
            <span class="badge badge-success">{{ __('Deposit') }}</span>
        @else
            <span class="badge badge-info">{{ __('Investment') }}</span>
        @endif
    </td>

</tr>
@empty
<tr>
    <td colspan="8" class="text-center">{{ __('No Data Found') }}
    </td>
</tr>
@endforelse