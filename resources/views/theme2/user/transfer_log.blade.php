@extends(template() . 'layout.master2')


@section('content2')
    <div class="dashboard-body-part">

        <div class="card">

            <div class="card-body text-end">
                <form action="" method="get" class="d-inline-flex">
                    <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                    <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                    <button type="submit" class="cmn-btn">{{ translate('Search') }}</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table cmn-table">
                    <thead>
                        <tr>
                            <th>{{ translate('Trx') }}</th>
                            <th>{{ translate('Sender') }}</th>
                            <th>{{ translate('Receiver') }}</th>
                            <th>{{ translate('Amount') }}</th>
                            <th>{{ translate('Currency') }}</th>
                            <th>{{ translate('Charge') }}</th>
                            <th>{{ translate('Details') }}</th>
                            <th>{{ translate('Payment Date') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transfers as $key => $transaction)
                            <tr>
                                <td data-caption="{{ translate('Trx') }}">{{ $transaction->transaction_id }}</td>

                                <td data-caption="{{ translate('Sender') }}">
                                    <p class="p-0 m-0">
                                       Name : {{ $transaction->sender->full_name }}
                                    </p>
                                    <p class="p-0 m-0">
                                      Email : {{ $transaction->sender->email }}
                                    </p>
                                </td>

                                <td data-caption="{{ translate('Receiver') }}">
                                    <p class="p-0 m-0">
                                        Name : {{ $transaction->receiver->full_name }}
                                    </p>
                                    <p class="p-0 m-0">
                                       Email : {{ $transaction->receiver->email }}
                                    </p>
                                </td>

                                <td data-caption="{{ translate('Amount') }}">{{ number_format($transaction->amount,2) }}</td>
                                <td data-caption="{{ translate('Currency') }}">{{ $general->site_currency }}</td>
                                <td data-caption="{{ translate('Charge') }}">
                                    {{ number_format($transaction->charge,2) . ' ' . $general->site_currency }}</td>
                                <td data-caption="{{ translate('Details') }}">{{ $transaction->details }}</td>
                                <td data-caption="{{ translate('Payment Date') }}">{{ $transaction->created_at->format('Y-m-d') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="100%">
                                    {{ translate('No Transaction Found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($transfers->hasPages())
                    {{ $transfers->links() }}
                @endif
            </div>
        </div>

    </div>
@endsection
