
@extends(template().'layout.master2')

@push('style')
    <style>
        .activebtn {
            background-color: #ffc451;
        }

    </style>

@endpush

@section('content2')

    <div class="dashboard-body-part">
        
        <div class="text-center">
            <div class="tab-btn-group">
                <a class="tab-btn {{ Request::routeIs('withdraw_all') ? 'active' : '' }}"
                    href="{{ route('withdraw_log') }}">{{ __('All Withdraw') }}</a>

                <!-- <a class="tab-btn {{ Request::routeIs('withdraw_pending') ? 'active' : '' }}"
                    href="{{ route('withdraw_pending') }}">{{ __('Pending Withdraw') }}</a>

                <a class="tab-btn {{ Request::routeIs('withdraw_complete') ? 'active' : '' }}"
                    href="{{ route('withdraw_complete') }}">{{ __('Complete Withdraw') }}</a> -->
            </div>
            <div class="card-body text-end mt-4">
               <!--  <form action="" method="get" class="d-inline-flex">
                    <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                    <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                    <button type="submit" class="cmn-btn">{{ __('Search') }}</button>
                </form> -->
            </div>
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Method Name') }}</th>
                        <th>{{ __('Withdraw Amount') }}</th>
                        <th>{{ __('Wallet Address') }}</th>
                        <th>{{ __('status') }}</th>
                        <!-- <th>{{ __('Action') }}</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $sn = 1; ?>
                    @forelse ($withdrawlogs as $withdrawlog)
                        <tr>
                            <td data-caption="{{ __('S/N') }}"><?php echo $sn; $sn++; ?></td>
                            <td data-caption="{{ __('Date') }}">{{ $withdrawlog->created_at }}</td>
                            <td data-caption="{{ __('Method Name') }}">{{ $withdrawlog->withdraw_method }}</td>
                            <td data-caption="{{__('Getable Amount')}}">
                                {{ $withdrawlog->amount  .'  ' .  $general->site_currency  }}
                            </td>
                            <td>


                                {{ $withdrawlog->wallet_address }}

                            </td>
                            
                            <td data-caption="{{ __('status') }}">
                                @if ($withdrawlog->status == 'success')
                                    <span
                                        class="badge badge-success">{{ __('Success') }}</span>
                                @elseif($withdrawlog->status == 'cancel')
                                    <span
                                        class="badge badge-danger">{{ __('Rejected') }}</span>
                                @else
                                    <span
                                        class="badge badge-warning">{{ __('Pending') }}</span>
                                @endif
                            </td>
                         <!--    <td data-caption="{{ __('Action') }}">
                                <button class="view-btn details" data-user_data="{{ json_encode($withdrawlog->user_withdraw_prof) }}" data-withdraw="{{ $withdrawlog }}"><i class="far fa-eye"></i></button>
                            </td> -->
                        </tr>
                    @empty
                        <tr>
                            <td data-caption="{{ __('Status') }}" class="text-center" colspan="100%">{{ __('No Data Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Withdraw Details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="withdraw-details">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>



@endsection


@push('script')

    <script>
        $(function() {
            'use strict'

            $('.details').on('click', function() {
                const modal = $('#details');

                let html = `

                    <ul class="list-group">
                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                               {{ __('Withdraw Adress') }}
                                <span>${$(this).data('user_data').wallet_address}</span>
                            </li>
                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                                {{ __('Withdraw Account Information') }}
                                <span>${$(this).data('user_data').account_info}</span>
                            </li>


                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                                {{ __('Note For Withdraw') }}
                                <span>${$(this).data('user_data').additional_info}</span>
                            </li>

                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                                {{ __('Withdraw Transaction') }}
                                <span>${$(this).data('withdraw').transaction_id}</span>
                            </li>


                        </ul>


                `;

                modal.find('.withdraw-details').html(html);

                modal.modal('show');
            })

        })
    </script>

@endpush
