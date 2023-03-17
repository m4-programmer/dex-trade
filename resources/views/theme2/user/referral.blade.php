<?php 
function template(){return 'theme2.';}
 ?>
@extends(template().'layout.master2')


@section('content2')
    <div class="dashboard-body-part">
        <h2 class="p-2">Refferal Log</h2>
        <div class="card-body text-end">
            <!-- <form action="" method="get" class="d-inline-flex">
                <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                <button type="submit" class="cmn-btn">{{__('Search')}}</button>
            </form> -->
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('User Referred') }}</th>
                        <th>{{ __('Amount Earned') }}</th>
                        <th>{{ __('Date') }}</th>
                        
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $id = 1;
                     ?>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td data-caption="{{ __('S/N') }}"><?php echo $id;$id++; ?></td>
                            <td data-caption="{{ __('User Referred') }}">{{ @$transaction->user->name }}</td>
                            <td data-caption="{{ __('Amount Earned') }}">
                               
                                    {{ @$transaction->amount_earned }}
                                
                            </td>
                            <td data-caption="{{ __('Date') }}">{{ $transaction->created_at}}</td>
                            
                           
                            
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="100%">
                                {{ __('No User Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

         
        </div>
    </div>
@endsection
