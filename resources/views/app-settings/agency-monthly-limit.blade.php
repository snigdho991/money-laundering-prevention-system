@extends('layouts.master')
@section('title', 'Set Monthly Transaction Limit')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Set Wire Money Monthly Transaction Limit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard </a></li>
                                <li class="breadcrumb-item active" style="color: #74788d;">Set Monthly Transaction Limit</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if(count($errors) > 0)
                                <div class="alert alert-dismissible fade show color-box bg-danger bg-gradient p-4" role="alert">
                                    <x-jet-validation-errors class="mb-4 my-2 text-white" />
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <form class="needs-validation" action="{{ route('update.limit') }}" method="post" enctype="multipart/form-data" novalidate="">
                                @csrf

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6" style="text-align: center;">
                                        <p><b>Your Current Wire Money Monthly Transaction Limit</b></p>

                                        <span class="btn btn-dark" style="cursor: default;font-size: 18px;">${{ $agency->monthly_limit }}</span>

                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Change Monthly Limit</label>
                                            <input type="number" min="1" class="form-control" placeholder="Enter Monthly Limit" name="monthly_limit" value="{{ old('monthly_limit', $agency->monthly_limit) }}" required="">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <button class="btn btn-info" style="margin-top: 6px !important; width: 100% !important" type="submit">Update Limit</button>
                                        
                                    </div>
                                                                  
                                </div>

                                <br>

                            </form>

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->                
                
@endsection