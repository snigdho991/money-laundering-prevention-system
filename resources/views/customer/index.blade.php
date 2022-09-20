@extends('layouts.master')
@section('title', 'Create Customer')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Customer List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer List</li>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Photo</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Work Company</th>
                                        <th>Transaction Tool</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                @foreach($customers as $customer)
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