<?php
use App\Models\GeneralSettings as GS;
$general = GS::get()->first();
?>
@extends('backend.layout.master')

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
            </div>


            <div class="row">

                <div class="col-md-12  col-lg-12 col-12 all-users-table">
                    <div class="card-header">
                        <h5>{{ __('Refferal List') }}</h5>
                    </div>
                    <div class="card">

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="">
                                            <th scope="col">{{ __('S/N') }}</th>
                                            <th scope="col">{{ __('User') }}</th>
                                            <th scope="col">{{ __('Referred User') }}</th>
                                            <th scope="col">{{ __('Amount Earned') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($Network as $data)
                                        <tr>
                                            
                                            <td>{{$loop->index}}</td>
                                            <td>{{$data->user->name}}</td>
                                            <td>{{$data->reffered->name}}</td>
                                            <td>{{$data->amount_earned}} {{$general->site_currency}}</td>
                                        </tr>
                                            @empty
                                        <tr>

                                            <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>

                                        </tr>
                                        
                                        @endforelse
                                    </tbody>
                                </table>


                            </div>

                        </div>

                    </div>
                    

        </section>
    </div>



@endsection

@push('script')
    <script>
        'use strict';
        $('.create-invest').hide();
        $('.create-interest').hide();

        $(document).ready(function() {

            $('#invest').on('click', function() {
                var value = $('.invest_commision').val();
                if (value > 5) {
                    iziToast.error({
                        message: 'Max Limit of Refferal level is 5 ',
                        position: 'topRight'
                    });

                    return;
                }
                var viewHtml = "";

                for (let i = 0; i < value; i++) {
                    viewHtml += `
          
            <div class="input-group mb-3 mt-3 ">
                <div class="input-group-prepend">
                                                <input class="btn btn-primary" type="text"  name=level[] value="level ${i+1}" readonly>
                                            </div>
                                            <input type="number" required class="form-control" name=commision[] 
                                                placeholder="Commision">

                                            <div class="input-group-append">
                                                <button class="btn btn-primary text-light no-drop" type="button"
                                                    >%</button>
                                                <button class="btn btn-danger text-white delete_invest" type="button"
                                                    >X</button>
                                            </div>


                                        </div>
             
             `
                    $('.append_invest').html(viewHtml).hide().slideDown('slow');
                    $('.invest_commision').val('');
                    $('.create-invest').show();

                }


            });
            $(document).on('click', '.delete_invest', function() {
                $(this).closest('.input-group').remove();

                var count = $('.append_invest').children().length;

                if (count == 0) {
                    $('.create-invest').hide();
                }

            });





            $('#interest').on('click', function() {
                var value = $('.interest_commision').val();
                var viewHtml = "";

                if (value > 5) {
                    iziToast.error({
                        message: 'Max Limit of Refferal level is 5 ',
                        position: 'topRight'
                    });

                    return;
                }


                for (let i = 0; i < value; i++) {
                    viewHtml += `
          
            <div class="input-group mb-3 mt-3 ">
                <div class="input-group-prepend">
                                                <input class="btn btn-success" type="text"  name="level[]"  value="level ${i+1}" readonly>
                                            </div>
                                            <input type="number" name=commision[] class="form-control"
                                                placeholder="Commision" min="0" required>

                                            <div class="input-group-append">
                                                <button class="btn btn-success text-light no-drop" type="button"
                                                    >%</button>
                                                <button class="btn btn-danger text-white delete_interest" type="button"
                                                    >X</button>
                                            </div>


                                        </div>
             
             `
                    $('.append_interest').html(viewHtml).hide().slideDown('slow');
                    $('.interest_commision').val('');
                    $('.create-interest').show();
                }


            });
            $(document).on('click', '.delete_interest', function() {
                $(this).closest('.input-group').remove();
                var count = $('.append_interest').children().length;

                if (count == 0) {
                    $('.create-interest').hide();
                }
            });
        });

        $(function() {

            $('#investstatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        iziToast.success({

                            message: response.success,
                            position: 'topRight'
                        });
                    }
                })
            })
        })

        $(function() {

            $('#intereststatus').on('change', function() {
                let status = $(this).data('status');
                let url = $(this).data('url');

                $.ajax({

                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },

                    url: url,

                    data: {
                        status: status
                    },

                    method: "POST",

                    success: function(response) {
                        iziToast.success({

                            message: response.success,
                            position: 'topRight'
                        });
                    }
                })
            })
        })
    </script>
@endpush
