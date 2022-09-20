@extends('layouts.master')
@section('title', 'Send Cheque')

@section('content')
    
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Send Cheque</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Send Cheque</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            
            <div class="checkout-tabs">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            
                            <a class="nav-link active" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab" aria-controls="v-pills-privacy" aria-selected="false"> 
                                <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Amount</p>
                            </a>
                            
                            <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab" aria-controls="v-pills-support" aria-selected="false">
                                <i class="bx bx-user-pin d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Fee</p>
                            </a>

                            <a class="nav-link" id="v-pills-upload-tab" data-bs-toggle="pill" href="#v-pills-upload" role="tab" aria-controls="v-pills-upload" aria-selected="false">
                                <i class="bx bx-upload d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Upload Cheque</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('transaction.send.cheque') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
                                @csrf

                                    <input type="hidden" name="customer_id" value="{{ $id }}">
                                    <div class="tab-content" id="v-pills-tabContent">

                                        <div class="tab-pane fade active show" id="v-pills-privacy" role="tabpanel" aria-labelledby="v-pills-privacy-tab">
                                            <h4 class="card-title mb-3">Select amount</h4>
                                            <p class="card-title-desc">
                                                You have to enter money amount that you want to send via your selected company. Please enter an amount in range of <b>1-3000</b>.
                                            </p>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">
                                                        <label for="validationTooltip02" class="form-label">Enter Amount</label>
                                                        <input type="number" min="1" max="3000" class="form-control" id="validationTooltip02" name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" required="">
                                                        <div class="valid-tooltip">
                                                            Looks good!
                                                        </div>

                                                        <div class="invalid-tooltip">
                                                            Please enter an amount in range of 1-3000
                                                        </div>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel" aria-labelledby="v-pills-support-tab">
                                            <h4 class="card-title mb-3">Fee</h4>
                                            <p class="card-title-desc">
                                                Enter an amount of money as fee for this transaction.
                                            </p>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">
                                                        <label for="validationTooltip03" class="form-label">Enter Fee</label>
                                                        <input type="number" min="1" max="3000" class="form-control" id="validationTooltip03" name="fee" value="{{ old('fee') }}" placeholder="Enter Amount" required="">
                                                        <div class="valid-tooltip">
                                                            Looks good!
                                                        </div>

                                                        <div class="invalid-tooltip">
                                                            Please enter a valid beneficiary.
                                                        </div>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-upload" role="tabpanel" aria-labelledby="v-pills-upload-tab">
                                            <h4 class="card-title mb-3">Upload Check Photo</h4>
                                            <p class="card-title-desc">
                                                Upload the cheque that you want to send.
                                            </p>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="image_upload_zone" for="">
                                                        <input type="file" accept="image/*" id="thumbnail" onchange="handleFileSelect(event)" name="file">
                                                        
                                                        <img src="http://review-app.test/public/backend/images/svgicon/upload.svg" alt="Upload">
                                                        
                                                        <div class="text">
                                                            <span>Drag And drop Image(s) Here</span>
                                                            <strong>Or</strong>
                                                            <br>
                                                            <button>Select Image(s)</button>
                                                            <br>
                                                            <span>
                                                                File Type: JPG,PNG,GIF,JPEG
                                                                <br>
                                                                Best Resulation: 1200x300
                                                                <br>
                                                                You must upload an image to proceed.
                                                            </span>
                                                        </div>
                                                    </label>

                                                    
                                                    <img id="preview"/>
                                                </div>   
                                            </div>

                                            <br>
                                            <button class="btn btn-primary" style="width: 100% !important" type="submit">Send Cheque</button>  
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content --> 
       
@endsection