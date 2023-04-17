
@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <h2 class="p-2">Refferal Log</h2>
        <div class="card-body text-end">
            <!-- <form action="" method="get" class="d-inline-flex">
                <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{translate('Search')}}</button>
            </form> -->
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ translate('S/N') }}</th>
                        <th>{{ translate('User Referred') }}</th>
                        <th>{{ translate('Amount Earned') }}</th>
                        <th>{{ translate('Date') }}</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                        $id = 1;
                     ?>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ translate('S/N') }}"><?php echo $id;$id++; ?></td>
                            <td data-caption="{{ translate('User Referred') }}">{{ @$transaction->user->name }}</td>
                            <td data-caption="{{ translate('Amount Earned') }}">

                                    {{ @$transaction->amount_earned }}

                            </td>
                            <td data-caption="{{ translate('Date') }}">{{ $transaction->created_at}}</td>



                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="100%">
                                {{ translate('No User Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
@endsection
