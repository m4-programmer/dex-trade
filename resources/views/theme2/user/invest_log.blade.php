
@extends(template().'layout.master2')


@section('content2')
    <script>
        'use strict'

        function getCountDown(elementId, seconds) {
            var times = seconds;
            var x = setInterval(function() {
                var distance = times * 1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById(elementId).innerHTML = days + "d " + hours + "h " + minutes + "m " +
                    seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                times--;
            }, 1000);
        }
    </script>

    <div class="dashboard-body-part">
        <h2 class="p-2">
            My Investment
        </h2>
        <!-- <div class="card-body text-end">
            <form action="" method="get" class="d-inline-flex">
                <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{translate('Search')}}</button>
            </form>
        </div> -->

        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ translate('S/N') }}</th>
                        <th>{{ translate('Trx') }}</th>
                        <th>{{ translate('Gateway') }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th>{{ translate('Plan') }}</th>
                        <th>{{ translate('Payment Date') }}</th>
                        <th>{{ translate('Investment Duration') }}</th>
                        <th>{{translate('Potential Cashout')}}</th>
                        <th>{{ translate('Payment Status') }}</th>
                        <th>{{ translate('Upcoming Payment') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $id = 1;
                     ?>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ translate('Trx') }}"><?php echo $id;$id++; ?></td>
                            <td data-caption="{{ translate('User') }}">{{ @$transaction->transaction_id }}</td>
                            <td data-caption="{{ translate('Gateway') }}">

                                    {{ @$transaction->gateway }}

                            </td>
                            <td data-caption="{{ translate('Amount') }}">{{ $transaction->amount }} {{ $gs->site_currency }}</td>

                            <td data-caption="{{ translate('Plan') }}">{{ $transaction->plan->name }}</td>

                            <!-- Date Paid -->

                            <td data-caption="{{ translate('Date Paid') }}">{{ $transaction->created_at }}</td>

                            <td data-caption="{{ translate('Investment Duration') }}">{{ $transaction->plan->duration }}</td>

                            <td data-caption="{{ translate('Potential Cashout') }}">{{ $transaction->amount + ($transaction->plan->amount * ($transaction->roi/100))}}</td>

                            <td data-caption="{{ translate('Payment Date') }}">
                                 @if($transaction->status == 'active')
                                    <button class="btn btn-sm btn-success" style="padding: 10px;">Active</button>

                                @elseif($transaction->status == 'ended')
                                    <button class="btn btn-sm btn-danger" style="padding: 10px;">Ended</button>

                                @else
                                    <button class="btn btn-sm btn-info" style="padding: 10px;">Pending</button>
                                @endif
                            </td>
                            <td data-caption="{{ translate('Upcoming Payment') }}">
                                @if($transaction->status == 'active')
                                <p id="count_{{ $loop->iteration }}" class="mb-2"></p>
                                <script>
                                    getCountDown("count_{{ $loop->iteration }}", "{{ now()->diffInSeconds($transaction->updated_at) }}")
                                </script>
                                @else
                                 -
                                @endif
                            </td>
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

{{--            @if ($transactions->hasPages())--}}
{{--                {{ $transactions->links() }}--}}
{{--            @endif--}}

        </div>
    </div>
@endsection

