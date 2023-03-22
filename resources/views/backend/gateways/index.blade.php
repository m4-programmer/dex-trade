@extends('backend.layout.master')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
            </div>

            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('admin.gateway.create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> {{__('Create Gateway')}}</a>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>{{__('Cryptocurrency')}}</th>
                                        <th>{{__('Wallet Address')}}</th>
                                        <th>{{__('Network')}}</th>
                                        <th>Image</th>
                                        <th>Short Name</th>
                                        <th>{{__('status')}}</th>
                                    </tr>
                                </thead>
                                
                                <tbody >

                                    @forelse ($gateways as $gateway)
                                        <tr >
                                            <td style="padding: 10px">{{$gateway->cryptocurrency}}</td>
                                            <td style="text-align: left;word-wrap: break-word;padding: 5px">{{$gateway->wallet_address}} </td>
                                            <td>{{$gateway->blockchain_network}}</td>
                                            <td>
                                                <img src="{{asset($gateway->image)}}" style="height:50px;border-radius: 50px;" class="img img-responsive">
                                            </td>
                                            <td>
                                                {{{$gateway->short_name}}}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.gateway.edit', $gateway)}}" class="btn btn-primary btn-sm">{{__('Edit')}}</a>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    <tr>
                                        <td colspan="100%" class="text-center">{{__('No Gateways Found')}}</td>
                                    </tr>
                                    @endforelse

                                </tbody>

                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
