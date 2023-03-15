<?php 
function template(){return 'theme2.';}
 ?>
@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
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
                        <th>{{ __('Trx') }}</th>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Gateway') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Currency') }}</th>
                        <th>{{ __('Charge') }}</th>
                        <th>{{ __('Payment Date') }}</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $id = 1;
                     ?>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ __('Trx') }}"><?php echo $id;$id++; ?></td>
                            <td data-caption="{{ __('User') }}">{{ @$transaction->user->name }}</td>
                            <td data-caption="{{ __('Gateway') }}">
                               
                                    {{ @$transaction->gateway }}
                                
                            </td>
                            <td data-caption="{{ __('Amount') }}">{{ $transaction->amount }} {{ $gs->site_currency }}</td>
                            
                            <!-- Date Paid -->

                            <td data-caption="{{ __('Payment Date') }}">{{ $transaction->created_at }}</td>
                            <td data-caption="{{ __('Payment Date') }}">
                                 @if($transaction->status != 'active')
                                    <button class="btn btn-sm btn-danger">Pending</button>
                                @else
                                    <button class="btn btn-sm btn-success">Success</button>
                                @endif
                            </td>
                            <td data-caption="{{ __('Upcoming Payment') }}">
                                @if($transaction->status != 'active')
                                    -
                                @else
                                <p id="count_{{ $loop->iteration }}" class="mb-2"></p>
                                <script>
                                    getCountDown("count_{{ $loop->iteration }}", "{{ now()->diffInSeconds($transaction->updated_at) }}")
                                </script>
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
