@extends('layouts.master')
@section('title', 'Transaction Information')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Transaction</h4>

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
                <div class="col-12">

                    <div class="alert bg-success bg-gradient text-white" style="text-align: center;font-weight: 550;" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        Good news! This Transaction has been completed successfully.

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                
                                <div class="media-body overflow-hidden">
                                    <h5 class="text-truncate font-size-15">Transaction ID : <span class="text-primary">{{ $transaction->transaction_id }}</span></h5>
                                    <p class="text-muted">You can track your own prefered transaction by using this qrcode link.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-size-15 mt-4">Transaction Details :</h5>
                                    <div class="text-muted mt-4">
                                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Type: <span style="text-transform: uppercase; font-weight: 550;">{{ $transaction->type }}</span></p>
                                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Amount: <span style="text-transform: uppercase; font-weight: 550;">{{ $transaction->amount }}</span></p>

                                        @if($transaction->type == 'wire-money')
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Beneficiary: <span style="text-transform: uppercase; font-weight: 550;">{{ $transaction->beneficiary }}</span></p>
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Company: <span style="text-transform: uppercase; font-weight: 550;">{{ App\Models\Company::where('id', $transaction->company_id)->first()->company_name }}</span></p>
                                        @else
                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Fee: <span style="text-transform: uppercase; font-weight: 550;">{{ $transaction->fee }}</span></p>

                                        @endif
                                        
                                    </div>
                                </div>

                                @if($transaction->type == 'cheque')
                                    <div class="col-md-6">
                                    <div class="zoom-gallery d-flex flex-wrap">
                                         <a href="{{ asset('assets/uploads/cheque-transaction/successful/'.$transaction->photo) }}" title="{{ $transaction->photo }}">   
                                            <img src="{{ asset('assets/uploads/cheque-transaction/successful/'.$transaction->photo) }}" style="height: 160px;" alt="transaction-cheque" width="275">
                                        </a>
                                    </div>
                                    </div>
                                @endif

                            </div>
                            
                            <?php
                                $date_time = strtotime($transaction->created_at);
                                $not_date = date('d M, Y', $date_time);

                                $newDateTime = date('h:i A', $date_time);
                            ?>
                            <div class="row task-dates">

                                <div class="col-sm-4 col-4">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date</h5>
                                        <p class="text-muted mb-0">{{ $not_date }} - {{ $newDateTime }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-4">
                                    <div class="mt-4">
                                        <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Since</h5>
                                        <p class="text-muted mb-0" style="margin-left: 22px;">{{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Transaction Tracker</h4>
                            <div class="">
                                <ul class="verti-timeline list-unstyled">
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-check-circle"></i>
                                        </div>
                                        <div class="media">
                                            <div class="me-3">
                                                <i class="bx bx-copy-alt h2 text-primary"></i>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <h5>Transaction Generated</h5>
                                                    <p class="text-muted">New transaction has been created by an agency successfully.</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="event-list active">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-check-circle bx-fade-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="me-3">
                                                <i class="bx bx-copy-alt h2 text-primary"></i>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <h5>Transaction Completed</h5>
                                                    <p class="text-muted">Transaction has been completed successfully.</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-sm-6" id="tooltip-container">
                    <div class="card text-center">
                        <div class="card-body">
                            <span class="badge rounded-pill badge-soft-primary font-size-11">Agency</span>
                            <div class="avatar-sm mx-auto mb-4">
                                <br><span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                    @if($agency->profile_photo_path)
                                        <img src="{{ asset('/assets/uploads/agency/'.$agency->photo) }}" alt="admin-pic" height="40" width="40" style="border-radius: 50%;">
                                    @else
                                        {{ avatarLetter($agency->name) }}
                                    @endif
                                </span>
                            </div>
                            <br><h5 class="font-size-15 mb-1"><a href="#" class="text-dark" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="left" title="{{ $agency->name }}">{{ $agency->name }}</a></h5>
                            <p class="text-muted">{{ $agency->email }}</p>

                        </div>
                    </div>

                    <?php
                        $customer = \App\Models\Customer::find($transaction->customer_id);
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                            <div class="avatar-md me-4">
                                <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                    @if($customer->photo)
                                        <img src="{{ asset('/assets/uploads/customer/'.$customer->photo) }}" alt="customer-pic" height="30">
                                    @else
                                        {{ avatarLetter($customer->name) }}
                                    @endif
                                </span>
                            </div>

                            <div class="media-body overflow-hidden">
                                <span class="badge rounded-pill badge-soft-info font-size-11">Customer</span>
                                <h5 class="text-truncate font-size-15 mt-2"><a href="#" class="text-dark" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="left" title="{{ $customer->name }}">{{ $customer->name }}</a></h5>
                                <p class="text-muted mb-4">{{ $customer->email }}</p>
                                
                            </div>
                            </div>
                        </div>                   
                    </div>
                
                </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection