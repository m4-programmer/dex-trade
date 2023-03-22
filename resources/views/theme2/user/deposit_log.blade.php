
@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <h2 class="p-2">Deposit Log</h2>
        <div class="card-body text-end">
            <form action="" method="get" class="d-inline-flex">
                <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{__('Search')}}</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Trx') }}</th>
                        <th>{{ __('CryptoCurrency') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Payment Date') }}</th>
                        <th>{{ __('Payment Status') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $id = 1;
                     ?>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ __('S/N') }}"><?php echo $id;$id++; ?></td>
                            <td data-caption="{{ __('Trx') }}">{{ @$transaction->transaction_id }}</td>
                            <td data-caption="{{ __('Gateway') }}">
                               
                                    {{ @$transaction->gateway }}
                                
                            </td>
                            <td data-caption="{{ __('Amount') }}">{{ $transaction->amount }} {{ $gs->site_currency }}</td>
                            
                            <!-- Date Paid -->

                            <td data-caption="{{ __('Payment Date') }}">{{ $transaction->created_at }}</td>
                            <td data-caption="{{ __('Payment Date') }}">
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
                                {{ __('No Deposit Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

         
        </div>
    </div>
@endsection
