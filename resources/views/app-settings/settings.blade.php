@extends('layouts.master')
@section('title', 'Change Logo')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Change Logo</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard </a></li>
                                <li class="breadcrumb-item active" style="color: #74788d;">Change Logo</li>
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
                            
                            <form class="needs-validation" action="{{ route('upload.logo') }}" method="post" enctype="multipart/form-data" novalidate="">
                                @csrf

                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <p style="text-align: center;"><b>Current Logo</b></p>
                                        <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/logo/'.$find_logo->logo) }}" title="{{ $find_logo->logo }}">
                                            <img class="img-fluid img-thumbnail rounded-circle" alt="" src="{{ asset('assets/uploads/logo/'.$find_logo->logo) }}" style="width:175px; height:175px;">
                                        </a>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Upload New Logo</label>
                                            <input type="file" class="form-control" placeholder="Upload New Logo" name="logo" required="">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <button class="btn btn-primary" style="margin-top: 6px !important; width: 100% !important" type="submit">Change  Logo</button>
                                        
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