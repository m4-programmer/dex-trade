@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <div class="card-body text-end">
            <form action="" method="get" class="d-inline-flex">

                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{ translate('Search') }}</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr class="bg-yellow">
                        <th>{{ translate('Plan Name') }}</th>
                        <th>{{ translate('Interest') }}</th>
                        <th>{{ translate('Invest Amount') }}</th>
                        <th>{{ translate('Payment Date') }}</th>
                        <th>{{ translate('Next Payment Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($interestLogs as $log)
                        <tr>
                            <td data-caption="{{ translate('Plan Name') }}">{{ $log->payment->plan->plan_name }}</td>
                            <td data-caption="{{ translate('Interest') }}">{{ number_format($log->interest_amount, 2) }}
                                {{ @$general->site_currency }}</td>
                            <td data-caption="{{ translate('Invest Amount') }}">{{ number_format($log->payment->amount, 2) }}
                                {{ @$general->site_currency }}</td>
                            <td data-caption="{{ translate('Payment Date') }}">{{ $log->created_at }}</td>
                            <td data-caption="{{ translate('Next Payment Date') }}">{{ isset($log->payment->next_payment_date) ? $log->payment->next_payment_date : 'Plan Expired' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="100%">{{ translate('No Data Found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
