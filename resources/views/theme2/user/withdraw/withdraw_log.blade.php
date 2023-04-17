
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
                    href="{{ route('withdraw_log') }}">{{ translate('All Withdraw') }}</a>

                <!-- <a class="tab-btn {{ Request::routeIs('withdraw_pending') ? 'active' : '' }}"
                    href="{{ route('withdraw_pending') }}">{{ translate('Pending Withdraw') }}</a>

                <a class="tab-btn {{ Request::routeIs('withdraw_complete') ? 'active' : '' }}"
                    href="{{ route('withdraw_complete') }}">{{ translate('Complete Withdraw') }}</a> -->
            </div>
            <div class="card-body text-end mt-4">
               <!--  <form action="" method="get" class="d-inline-flex">
                    <input type="text" name="trx" class="form-control me-2" placeholder="transaction id">
                    <input type="date" class="form-control me-3" placeholder="Search User" name="date">
                    <button type="submit" class="cmn-btn">{{ translate('Search') }}</button>
                </form> -->
            </div>
        </div>
        <div class="table-responsive">
            <table class="table cmn-table">
                <thead>
                    <tr>
                        <th>{{ translate('S/N') }}</th>
                        <th>{{ translate('Date') }}</th>
                        <th>{{ translate('Method Name') }}</th>
                        <th>{{ translate('Withdraw Amount') }}</th>
                        <th>{{ translate('Wallet Address') }}</th>
                        <th>{{ translate('status') }}</th>
                        <!-- <th>{{ translate('Action') }}</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $sn = 1; ?>
                    @forelse ($withdrawlogs as $withdrawlog)
                        <tr>
                            <td data-caption="{{ translate('S/N') }}"><?php echo $sn; $sn++; ?></td>
                            <td data-caption="{{ translate('Date') }}">{{ $withdrawlog->created_at }}</td>
                            <td data-caption="{{ translate('Method Name') }}">{{ $withdrawlog->withdraw_method }}</td>
                            <td data-caption="{{translate('Getable Amount')}}">
                                {{ $withdrawlog->amount  .'  ' .  $general->site_currency  }}
                            </td>
                            <td>


                                {{ $withdrawlog->wallet_address }}

                            </td>

                            <td data-caption="{{ translate('status') }}">
                                @if ($withdrawlog->status == 'success')
                                    <span
                                        class="badge badge-success">{{ translate('Success') }}</span>
                                @elseif($withdrawlog->status == 'cancel')
                                    <span
                                        class="badge badge-danger">{{ translate('Rejected') }}</span>
                                @else
                                    <span
                                        class="badge badge-warning">{{ translate('Pending') }}</span>
                                @endif
                            </td>
                         <!--    <td data-caption="{{ translate('Action') }}">
                                <button class="view-btn details" data-user_data="{{ json_encode($withdrawlog->user_withdraw_prof) }}" data-withdraw="{{ $withdrawlog }}"><i class="far fa-eye"></i></button>
                            </td> -->
                        </tr>
                    @empty
                        <tr>
                            <td data-caption="{{ translate('Status') }}" class="text-center" colspan="100%">{{ translate('No Data Found') }}
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
                    <h5 class="modal-title">{{ translate('Withdraw Details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="withdraw-details">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ translate('Close') }}</button>
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
                               {{ translate('Withdraw Adress') }}
                                <span>${$(this).data('user_data').wallet_address}</span>
                            </li>
                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                                {{ translate('Withdraw Account Information') }}
                                <span>${$(this).data('user_data').account_info}</span>
                            </li>


                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                                {{ translate('Note For Withdraw') }}
                                <span>${$(this).data('user_data').additional_info}</span>
                            </li>

                            <li class="list-group-item text-white d-flex justify-content-between align-items-center">
                                {{ translate('Withdraw Transaction') }}
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
