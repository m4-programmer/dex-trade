@extends('backend.layout.master')


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle)  }}</h1>
            </div>

            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card" >

                        <div class="card-body p-2" >

                            <table class="table table-striped table-responsive" style="width:100%"  id="myTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Sl') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <?php if (isset($payment_type)): ?>
                                        <th>Plan</th>
                                        <th>Payment Method</th>
                                        
                                        <th>Date Paid</th>
                                        <?php endif ?>
                                        <th>{{ __('Amount') }} <?php if (isset($payment_type)): ?>
                                            Paid
                                        <?php endif ?></th>
                                        <?php if (!isset($payment_type)): ?>
                                            
                                        <th>{{ __('Type') }}</th>
                                        <?php endif ?>
                                        <th>{{ __('status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($manuals as $key => $manual)
                                        <tr>
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $manual->user->name }}</td>
                                            
                                             <?php if (isset($payment_type)): ?>
                                               <td>{{$manual->plan_name}}</td>
                                               <td>{{$manual->gateway}}</td>
                                               
                                               <td>{{$manual->created_at}}</td>
                                            <?php endif ?>
                                            <td>{{ number_format($manual->amount, 2) . ' ' . @$general->site_currency }}
                                            </td>

                                            <?php if (!isset($payment_type)): ?>
                                            
                                            <td>
                                                {{ ucwords($manual->payment_type ?? $payment_type)}}

                                            </td>
                                            <?php endif ?>
                                            <?php if (!isset($payment_type)): ?>
                                            <td>
                                                @if ($manual->status == 'pending')
                                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                @elseif($manual->status == "success")
                                                    <span class="badge badge-success">{{ __('Success') }}</span>
                                                @elseif($manual->status == "rejected")
                                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>
                                            <?php else: ?>
                                             <td>
                                                @if ($manual->status == 'pending')
                                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                @elseif($manual->status == "active")
                                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                                @elseif($manual->status == "ended")
                                                    <span class="badge badge-danger">{{ __('Ended') }}</span>
                                                @endif
                                            </td>
                                            <?php endif ?>
                                            <?php if (!isset($payment_type)): ?>
                                                <!-- This action data belongs to deposit -->
                                            <td>
                                                <a class="btn btn-md btn-info details"
                                                    href="{{ route('admin.deposit.trx', $manual->transaction_id) }}">{{ __('Details') }}</a>

                                                @if ($manual->status == "pending")
                                                    <a class="btn text-white btn-md btn-primary accept"
                                                        data-url="{{ route('admin.deposit.accept', $manual->transaction_id) }}" title="Accept">{{ __('Accept') }}</a>
                                                    <a class="btn text-white btn-md btn-danger reject"
                                                        data-url="{{ route('admin.deposit.reject', $manual->transaction_id) }}" title="Reject">{{ __('Reject') }}</a>
                                                @endif
                                            </td>

                                            <?php else: ?>
                                            <td>
                                                <a class="btn btn-md btn-info details"
                                                    href="{{ route('admin.investment.details', $manual->transaction_id) }}">{{ __('Details') }}</a>
                                                
                                                @if ( !isset($payment_type) and $manual->status == "pending")
                                                    <a class="btn text-white btn-md btn-primary accept"
                                                        data-url="{{ route('admin.deposit.accept', $manual->transaction_id) }}" title="Accept">{{ __('Accept') }}</a>
                                                    <a class="btn text-white btn-md btn-danger reject"
                                                        data-url="{{ route('admin.deposit.reject', $manual->transaction_id) }}" title="Reject">{{ __('Reject') }}</a>
                                                @endif
                                            </td>
                                             <?php endif ?>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                        @if ($manuals->hasPages())
                            <div class="card-footer">
                                {{ $manuals->links('backend.partial.paginate') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </section>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Accept') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>{{ __('Are you sure to Accept this Payment request') }}?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Accept') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Reject') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>{{ __('Are you sure to reject this payment') }}?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('style-plugin')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/admin/css/bs4-datatable.min.css') }}">
@endpush

@push('script-plugin')
    <script src="{{ asset('asset/admin/js/datatables.min.js') }}"></script>
    <script src="{{ asset('asset/admin/js/bs4-datatable.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .pagination .page-item.active .page-link {
            background-color: rgb(95, 116, 235);
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
            background: transparent;
            border-color: transparent;
        }



        .pagination .page-item.active .page-link:hover {
            background-color: rgb(95, 116, 235);
        }

        th,
        td {
            text-align: center !important;
        }
    </style>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'
            $('#myTable').DataTable();

            $('.accept').on('click', function() {
                const modal = $('#accept');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })

            $('.reject').on('click', function() {
                const modal = $('#reject');

                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })



        })
    </script>
@endpush