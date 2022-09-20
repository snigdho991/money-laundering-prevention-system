@extends('layouts.master')
@section('title', 'Get Started | Transaction')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Transaction</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">

                    <div class="card text-center">
                        <div class="card-body">
                            <span class="badge rounded-pill badge-soft-primary font-size-11">Customer</span>
                            <div class="avatar-sm mx-auto mb-4">
                                <br><span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                    @if($customer->photo)
                                        <a class="image-popup-vertical-fit" href="{{ asset('/assets/uploads/customer/'.$customer->photo) }}" title="{{ $customer->photo }}">
                                            <img src="{{ asset('/assets/uploads/customer/'.$customer->photo) }}" alt="agency-pic" height="40" width="40" style="border-radius: 50%;">
                                        </a>
                                    @else
                                        {{ avatarLetter($customer->name) }}
                                    @endif
                                </span>
                            </div>
                            <br><h5 class="font-size-16 mb-1">{{ $customer->name }}</h5>
                            <p class="text-muted">{{ $customer->email }}</p>

                        </div>
                    </div>

                </div> <!-- end col -->
                <div class="col-xl-2"></div>
            </div>

            <div class="row">
                <div class="col-xl-12 text-center">
                    <h4 class="mb-sm-0 font-size-18">Select an Option</h4>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card border border-primary">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="mdi mdi-bullseye-arrow me-3"></i>Cheque</h5>

                            <div class="d-flex justify-content-center" style="margin-top: 10px; margin-bottom: -15px;">
                                <div class="spinner-grow text-primary m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title mt-0">Type : Cheque</h5>
                            <p class="card-text" style="text-align: justify;">Click on th below button to go with cheque. Each time there will be an automatically generated access token for security reason.</p>
                        </div>
                    <?php
                        
                    ?>
                        <div class="card-footer">
                            <a href="{{ route('transaction.cheque', ['id' => $id, 'accessToken' => $key]) }}" style="width: 100%;" class="btn btn-primary waves-effect waves-light">Process Cheque</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border border-success">
                        <div class="card-header bg-transparent border-success">
                            <h5 class="my-0 text-success text-center"><i class="mdi mdi-check-all me-3"></i>Wire Money</h5>

                            <div class="d-flex justify-content-center" style="margin-top: 10px; margin-bottom: -15px;">
                                <div class="spinner-grow text-success m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title mt-0">Type : Wire Money</h5>
                            <p class="card-text" style="text-align: justify;">Click on th below button to go with wire money. Each time there will be an automatically generated access token for security reason.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('transaction.wiremoney', ['id' => $id, 'securityToken' => $wire_key]) }}" style="width: 100%;" class="btn btn-success waves-effect waves-light">Process Wire Money</a>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection