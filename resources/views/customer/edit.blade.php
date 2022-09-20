@extends('layouts.master')
@section('title', 'Edit Customer')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Customer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard </a></li>
                                <li class="breadcrumb-item active" style="color: #74788d;">Edit Customer</li>
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
                            
                            <form class="needs-validation" action="{{ route('customer.update', $customer->id) }}" method="post" enctype="multipart/form-data" novalidate="">
                                @method('PATCH')
                                @csrf

                                @if($customer->photo != null)
                                    <div class="row">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-2">
                                            <p style="text-align: center;">Current Profile Picture</p>
                                            <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/'.$customer->photo) }}" title="{{ $customer->photo }}">
                                                <img class="img-fluid img-thumbnail rounded-circle" alt="" src="{{ asset('assets/uploads/customer/'.$customer->photo) }}" style="width:175px; height:175px;">
                                            </a>
                                        </div>
                                        <div class="col-md-5"></div>
                                    </div>
                                    <br>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip01" class="form-label">Customer Name</label>
                                            <input type="text" class="form-control" id="validationTooltip01" placeholder="Enter Customer name" name="name" value="{{ old('name', $customer->name) }}" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter customer name.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip02" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="validationTooltip02" name="email" value="{{ old('email', $customer->email) }}" placeholder="Enter E-mail Address" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter valid E-mail address.
                                            </div>
                                        </div>
                                    </div>                                               
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="" class="form-label">Upload Photo</label>
                                            <input type="file" class="form-control" id="" placeholder="Upload Photo" name="photo">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please upload a photo.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip04" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="validationTooltip04" name="address" value="{{ old('address', $customer->address) }}" placeholder="Enter Present Address" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter valid present customer address.
                                            </div>
                                        </div>
                                    </div>                                               
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip05" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="validationTooltip05" placeholder="Enter Phone" name="phone" value="{{ old('phone', $customer->phone) }}" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter valid phone number.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip06" class="form-label">Customer Work Company</label>
                                            <input type="text" class="form-control" id="validationTooltip06" placeholder="Enter Customer Work Company" name="customer_company" value="{{ old('customer_company', $customer->customer_company) }}" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter customer work company.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip11" class="form-label">Change ID-1</label>
                                            <input type="file" class="form-control" id="validationTooltip11" placeholder="Upload ID-1" name="id1">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please upload ID-1.
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Current ID-1: </label>
                                                <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/id1/'.$customer->id1) }}" title="{{ $customer->id1 }}">
                                                    <img class="img-fluid img-thumbnail rounded-circle" alt="" src="{{ asset('assets/uploads/customer/id1/'.$customer->id1) }}" style="width:175px; height:175px;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip12" class="form-label">Change ID-2</label>
                                            <input type="file" class="form-control" id="validationTooltip12" placeholder="Upload ID-2" name="id2">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please upload ID-2.
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Current ID-2: </label>
                                                <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/id2/'.$customer->id2) }}" title="{{ $customer->id2 }}">
                                                    <img class="img-fluid img-thumbnail rounded-circle" alt="" src="{{ asset('assets/uploads/customer/id2/'.$customer->id2) }}" style="width:175px; height:175px;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative" style="text-align: center;">
                                            <label for="validationTooltip13" class="form-label">Change ID-3</label>
                                            <input type="file" class="form-control" id="validationTooltip13" placeholder="Upload ID-3" name="id3">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please upload ID-3.
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6" style="margin: auto;">
                                                <label for="">Current ID-3: </label>
                                                <a class="image-popup-vertical-fit" href="{{ asset('assets/uploads/customer/id3/'.$customer->id3) }}" title="{{ $customer->id3 }}">
                                                    <img class="img-fluid img-thumbnail rounded-circle" alt="" src="{{ asset('assets/uploads/customer/id3/'.$customer->id3) }}" style="width:175px; height:175px;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" style="margin-top: 6px !important; width: 100% !important" type="submit">Edit Customer</button>
                                    </div>
                                </div>

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