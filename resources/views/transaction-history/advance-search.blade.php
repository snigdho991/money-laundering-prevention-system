@extends('layouts.master')
@section('title', 'Advanced Search Functionality')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Advanced Search Functionality</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Advanced Search Functionality</li>
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
                            <form action="{{ route('report.advanced.search') }}" class="needs-validation" novalidate="" method="get">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label>Start Date</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" id="validationTooltip01" placeholder="yyyy-mm-dd" name="from" data-date-format="yyyy-mm-dd" data-date-container="#datepicker1" data-provide="datepicker" required="">

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>

                                                <div class="invalid-tooltip">
                                                    Please select start date.
                                                </div>
                                            </div><!-- input-group -->
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label>End Date</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="yyyy-mm-dd" name="to" data-date-format="yyyy-mm-dd" data-date-container="#datepicker1" data-provide="datepicker" required="">

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>

                                                <div class="invalid-tooltip">
                                                    Please select end date.
                                                </div>
                                            </div><!-- input-group -->
                                        </div>

                                        <button type="submit" style="float: right;" class="btn btn-dark waves-effect">
                                            <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i> Search Now
                                        </button>
                                    </div>
                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

            @if($from != null && $to!= null)
                
                @if(count($search_results) < 1)
                    <div class="alert alert-dismissible fade show color-box bg-danger bg-gradient" role="alert">
                        <span class="mb-4 my-2 text-white">No result found From <strong>{{ date('d M, Y', strtotime($from)) }}</strong> To <strong>{{ date('d M, Y', strtotime($to)) }}</strong>. Try again later!</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    <div class="alert alert-dismissible fade show color-box bg-success bg-gradient" role="alert">
                        <span class="mb-4 my-2 text-white"><strong>{{ count($search_results) }}</strong> results found! Showing Results From <strong>{{ date('d M, Y', strtotime($from)) }}</strong> To <strong>{{ date('d M, Y', strtotime($to)) }}</strong></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            @endif


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            SL
                                        </th>
                                        <th class="align-middle">Transaction ID</th>
                                        <th class="align-middle">Date</th>
                                        <th class="align-middle">Customer Name</th>
                                        <th class="align-middle">Amount</th>
                                        <th class="align-middle">Method</th>
                                        <th class="align-middle">View Details</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($search_results as $key => $search_result)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td><span class="text-body fw-bold">{{ $search_result->transaction_id }}</span>
                                        </td>
                                        <td>
                                            <?php
                                                $date_time = strtotime($search_result->created_at);
                                                $not_date = date('d M, Y', $date_time);
                                            ?>
                                            {{ $not_date }}
                                        </td>
                                        <?php 
                                            $find_cus = \App\Models\Customer::find($search_result->customer_id);
                                        ?>

                                        <td id="tooltip-container">
                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $find_cus->name }}">{{ substr(strip_tags($find_cus->name), 0, 12) . '...' }}</span>
                                        </td>
                                        
                                        <td>
                                            ${{ $search_result->amount }}
                                        </td>

                                        <td>
                                            @if($search_result->type == 'cheque') 
                                                <i class="far fa-credit-card"></i> Cheque
                                            @else
                                                <i class="far fa-money-bill-alt"></i> Wire Money
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <a href="{{ route('transaction.manage', $search_result->transaction_id) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
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