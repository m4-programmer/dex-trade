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

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">

                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="example">
                                    <thead>
                                        <tr>

                                            <th>{{ __('Sl') }}</th>
                                            <th>{{ __('Full Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>Username</th>
                                            <th>{{ __('Phone') }}</th>
                                            
                                            <th>{{ __('Country') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>

                                        </tr>

                                    </thead>

                                    <tbody id="filter_data">

                                        @forelse($users as $key => $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{$user->username}}</td>
                                                <td>{{ $user->phone }}</td>
                                                
                                                <td>{{ @$user->country ?? 'N/A' }}</td>
                                                <td>

                                                   
                                                        <span class='badge badge-success'>{{ __('Active') }}</span>
                                                   

                                                </td>

                                                <td>

                                                    <a href="{{ route('admin.user.details', $user) }}"
                                                        class="btn btn-sm btn-outline-primary"><i class="fa fa-eye mr-2"></i>{{ __('Details') }}</a>

                                                </td>


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


                        @if ($users->hasPages())
                            <div class="card-footer">
                                {{ $users->links('backend.partial.paginate') }}
                            </div>
                        @endif

                    </div>



                </div>


            </div>
        </section>
    </div>
@endsection
