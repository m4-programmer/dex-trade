
@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <h2 class="p-2">Deposit Log</h2>
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
                        <th>{{ translate('S/N') }}</th>
                        <th>{{ translate('Trx') }}</th>
                        <th>{{ translate('CryptoCurrency') }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th>{{ translate('Payment Date') }}</th>
                        <th>{{ translate('Payment Status') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $id = 1;
                     ?>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ translate('S/N') }}"><?php echo $id;$id++; ?></td>
                            <td data-caption="{{ translate('Trx') }}">{{ @$transaction->transaction_id }}</td>
                            <td data-caption="{{ translate('Gateway') }}">

                                    {{ @$transaction->gateway }}

                            </td>
                            <td data-caption="{{ translate('Amount') }}">{{ $transaction->amount }} {{ $gs->site_currency }}</td>

                            <!-- Date Paid -->

                            <td data-caption="{{ translate('Payment Date') }}">{{ $transaction->created_at }}</td>
                            <td data-caption="{{ translate('Payment Date') }}">
                                 @if($transaction->status != 'success')
                                    <button class="btn btn-danger" style="padding: 5px">Pending Approval</button>
                                @else
                                    <button class="btn btn-sm btn-success">Successful</button>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="100%">
                                {{ translate('No Deposit Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
@endsection
