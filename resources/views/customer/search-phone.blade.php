@extends('layouts.master')
@section('title', 'Search Customer By Phone Number')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Customer By Phone Number</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer By Phone Number</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if($customer_phone != null)
                
                @if(!$customer)
                    <div class="alert fade show color-box bg-danger bg-gradient" role="alert">
                        <span class="mb-4 my-2 text-white">No result found by this phone number - <strong>{{ $customer_phone }}</strong>. Try again later!</span>
                        
                    </div>
                @else
                    <div class="alert fade show color-box bg-success bg-gradient" role="alert">
                        <span class="mb-4 my-2 text-white"><strong>1</strong> result found! Phone number is - <strong>{{ $customer_phone }}</strong></span>
                        
                    </div>
                @endif

            @endif


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>photo</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Work Company</th>
                                        <th>Transaction Tool</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                @if($customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            @if($customer->photo != null)
                                                <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/'.$customer->photo) }}" title="{{ $customer->photo }}">
                                                    <img class="img-fluid" alt="" src="{{ asset('assets/uploads/customer/'.$customer->photo) }}" style="width:90px !important; height:40px !important;">
                                                </a>
                                            @else
                                                <span class="text-danger" style="font-weight:600;">Not Available</span>
                                            @endif                                            
                                        </td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->customer_company }}</td>
                                        <td><a class="btn btn-danger btn-sm waves-effect btn-label waves-light" href="{{ route('transaction.getstarted', $customer->id) }}" title="New Transaction">
                                                <i class="bx bx-money label-icon"></i> New Transaction
                                            </a>
                                        </td>
                                        <td>
                                            <div class="inline" style="display: flex; gap: 5px;">
                                                <a class="btn btn-outline-info btn-sm edit" href="{{ route('customer.edit', $customer->id) }}" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                
                                                <form method="POST" action="{{ route('customer.destroy', $customer->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-outline-danger btn-sm delete" onclick="return confirm('Are you sure to delete?')" style="margin-left: 5px;" title="Delete" type="submit"><i class="fas fa-trash-alt"></i></button> 
                                                </form>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div> <!-- end col -->
            </div>

        @if($customer)
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="text-align: center;">
                    
                    <span class="btn btn-primary" style="cursor: default;font-size: 13px;">ID PROOFS</span>

                </div>
                <div class="col-md-3"></div>
            </div>

            <br>

            <div class="row" style="text-align: center;">
                <div class="col-4"><i class="bx bx-cloud-upload bx-fade-left" style="font-size:25px; color: #4458b8;"></i> <span style="position: relative; bottom: 5px; font-weight: 550;" for="">ID-1</span></div>
                <div class="col-4"><i class="bx bx-cloud-upload bx-fade-left" style="font-size:25px; color: #4458b8;"></i> <span style="position: relative; bottom: 5px; font-weight: 550;" for="">ID-2</span></div>
                <div class="col-4"><i class="bx bx-cloud-upload bx-fade-left" style="font-size:25px; color: #4458b8;"></i> <span style="position: relative; bottom: 5px; font-weight: 550;" for="">ID-1</span></div>
            </div>

            <div class="row" style="text-align: center;">
                
                <div class="col-4 col-md-4" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <img class="rounded mr-2" alt="200x200" style="width: 200px; height: 150px;" src="{{ asset('assets/uploads/customer/id1/'.$customer->id1) }}" data-holder-rendered="true">

                    <div class="divide" style="text-align: justify;">
                        <p><a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/id1/'.$customer->id1) }}" style="color: #343a40;" title="{{ $customer->id1 }}"><b>View</b></a></p>
                        
                        <p><a href="{{ asset('assets/uploads/customer/id1/'.$customer->id1) }}" download="{{ $customer->id1 }}" style="color: #343a40;"><b>Download</b></a></p>
                        
                        <p><a href="{{ route('customer.edit', $customer->id) }}" style="color: #343a40;" target="_blank"><b>Change</b></a></p>
                    </div>
                </div>


                <div class="col-4 col-md-4" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <img class="rounded mr-2" alt="200x200" style="width: 200px; height: 150px;" src="{{ asset('assets/uploads/customer/id2/'.$customer->id2) }}" data-holder-rendered="true">

                    <div class="divide" style="text-align: justify;">
                        <p><a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/id2/'.$customer->id2) }}" style="color: #343a40;" title="{{ $customer->id2 }}"><b>View</b></a></p>
                        
                        <p><a href="{{ asset('assets/uploads/customer/id2/'.$customer->id2) }}" download="{{ $customer->id2 }}" style="color: #343a40;"><b>Download</b></a></p>
                        
                        <p><a href="{{ route('customer.edit', $customer->id) }}" style="color: #343a40;" target="_blank"><b>Change</b></a></p>
                    </div>
                </div>


                <div class="col-4 col-md-4" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <img class="rounded mr-2" alt="200x200" style="width: 200px; height: 150px;" src="{{ asset('assets/uploads/customer/id3/'.$customer->id3) }}" data-holder-rendered="true">

                    <div class="divide" style="text-align: justify;">
                        <p><a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/id3/'.$customer->id3) }}" style="color: #343a40;" title="{{ $customer->id3 }}"><b>View</b></a></p>
                        
                        <p><a href="{{ asset('assets/uploads/customer/id3/'.$customer->id3) }}" download="{{ $customer->id3 }}" style="color: #343a40;"><b>Download</b></a></p>
                        
                        <p><a href="{{ route('customer.edit', $customer->id) }}" style="color: #343a40;" target="_blank"><b>Change</b></a></p>
                    </div>
                </div>

            </div>

            <br>
            <br>
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="text-align: center;">
                    <p><b>CUSTOMER NAME</b></p>

                    <span class="btn btn-dark" style="cursor: default;font-size: 13px;">{{ $customer->name }}</span>

                </div>
                <div class="col-md-3"></div>
            </div>

            <br>
            @if($total_amount > $agency->monthly_limit)
                
                <div class="alert fade show color-box bg-danger bg-gradient" role="alert">
                    <span class="mb-4 my-2 text-white">This customer's transaction is larger than agency monthly limit. Monthly limit is - <strong>{{ number_format((float)$agency->monthly_limit, 2, '.', '') }}</strong> but transaction is - <b>{{ $total_amount }}</b></span>
                    
                </div>
            @else
                <div class="alert fade show color-box bg-success bg-gradient" role="alert">
                <span class="mb-4 my-2 text-white">
                    Monthly limit is - <strong>{{ number_format((float)$agency->monthly_limit, 2, '.', '') }}</strong> and transaction is - <strong>{{ $total_amount }}  </strong></span>
                </span>
                    
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Wire Money Transactions (This Month : <span class="text-primary"> {{ \Carbon\Carbon::now()->format('F') }}</span>)</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 20px;">
                                                SL
                                            </th>
                                            <th class="align-middle">Transaction ID</th>
                                            <th class="align-middle">Date</th>                            
                                            <th class="align-middle">Company Name</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Beneficiary</th>
                                            <th class="align-middle">View Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($customer_wire_transactions as $key => $wire_transaction)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td><span class="text-body fw-bold">{{ $wire_transaction->transaction_id }}</span>
                                                </td>
                                                <td>
                                                    <?php
                                                        $date_time = strtotime($wire_transaction->created_at);
                                                        $not_date = date('d M, Y', $date_time);
                                                    ?>
                                                    {{ $not_date }}
                                                </td>
                                            <?php 
                                                $find_com = \App\Models\Company::find($wire_transaction->company_id);                                                
                                            ?>

                                            
                                                <td>
                                                    {{ $find_com->company_name }}
                                                </td>
                                                
                                                <td>
                                                    ${{ $wire_transaction->amount }}
                                                </td>

                                                <td>
                                                    {{ $wire_transaction->beneficiary }}
                                                </td>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ route('transaction.manage', $wire_transaction->transaction_id) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <p style="text-align: center;"><a class="btn btn-primary waves-effect waves-light" href="{{ route('agency.dashboard') }}"><i class="fas fa-home"></i> Back to Dashboard</a></p>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection