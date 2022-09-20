@extends('layouts.master')
@section('title', 'Cheque Transactions')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Cheque Transactions</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Cheque Transactions</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                            <th style="width: 20px;">
                                                SL
                                            </th>
                                            <th class="align-middle">Transaction ID</th>
                                            <th class="align-middle">Date</th>
                                        @if(Auth::user()->role == 'Agency')
                                            <th class="align-middle">Customer Name</th>
                                        @elseif(Auth::user()->role == 'Administrator')
                                            <th class="align-middle">Customer Name</th>
                                            <th class="align-middle">Agency Name</th>
                                        @endif
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Fee</th>
                                            <th class="align-middle">Cheque Image</th>
                                            <th class="align-middle">View Details</th>
                                    </tr>
                                </thead>


                                <tbody>
                                @foreach($cheque_transactions as $key => $cheque_transaction)
                                    <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td><span class="text-body fw-bold">{{ $cheque_transaction->transaction_id }}</span>
                                            </td>
                                            <td>
                                                <?php
                                                    $date_time = strtotime($cheque_transaction->created_at);
                                                    $not_date = date('d M, Y', $date_time);
                                                ?>
                                                {{ $not_date }}
                                            </td>
                                        <?php 
                                            $find_cus = \App\Models\Customer::find($cheque_transaction->customer_id);
                                            $find_agency = \App\Models\User::find($cheque_transaction->agency_user_id);
                                            
                                        ?>

                                        @if(Auth::user()->role == 'Agency')
                                            <td id="tooltip-container">
                                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $find_cus->name }}">{{ substr(strip_tags($find_cus->name), 0, 12) . '...' }}</span>
                                            </td>
                                            
                                        @elseif(Auth::user()->role == 'Administrator')
                                            <td id="tooltip-container">
                                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $find_cus->name }}">{{ substr(strip_tags($find_cus->name), 0, 12) . '...' }}</span>
                                            </td>
                                            
                                            <td id="tooltip-container">
                                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $find_agency->name }}">{{ substr(strip_tags($find_agency->name), 0, 12) . '...' }}</span>
                                            </td>
                                        
                                        @endif
                                            
                                            <td>
                                                ${{ $cheque_transaction->amount }}
                                            </td>

                                            <td>
                                                ${{ $cheque_transaction->fee }}
                                            </td>

                                            <td>
                                                <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/cheque-transaction/successful/'.$cheque_transaction->photo) }}" title="{{ $cheque_transaction->photo }}">
                                                    <img class="img-fluid" alt="" src="{{ asset('assets/uploads/cheque-transaction/successful/'.$cheque_transaction->photo) }}" style="width:90px !important; height:40px !important;">
                                                </a>
                                            </td>
                                            
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="{{ route('transaction.manage', $cheque_transaction->transaction_id) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                    View Details
                                                </a>
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection