@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <div class="card-body text-end">
            <form action="" method="get" class="d-inline-flex">
                <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{translate('Search')}}</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ translate('Trx') }}</th>
                        <th>{{ translate('User') }}</th>
                        <th>{{ translate('Gateway') }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th>{{ translate('Currency') }}</th>
                        <th>{{ translate('Charge') }}</th>
                        <th>{{ translate('Details') }}</th>
                        <th>{{ translate('Payment Date') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ translate('Trx') }}">{{ $transaction->trx }}</td>
                            <td data-caption="{{ translate('User') }}">{{ @$transaction->user->fname . ' ' . @$transaction->user->lname }}</td>
                            <td data-caption="{{ translate('Gateway') }}">{{ @$transaction->gateway->gateway_name ?? 'Account Transfer' }}</td>
                            <td data-caption="{{ translate('Amount') }}">{{ $transaction->amount }}</td>
                            <td data-caption="{{ translate('Currency') }}">{{ $transaction->currency }}</td>
                            <td data-caption="{{ translate('Charge') }}">{{ $transaction->charge . ' ' . $transaction->currency }}</td>
                            <td data-caption="{{ translate('Details') }}">{{ $transaction->details }}</td>
                            <td data-caption="{{ translate('Payment Date') }}">{{ $transaction->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="100%">
                                {{ translate('No users Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
