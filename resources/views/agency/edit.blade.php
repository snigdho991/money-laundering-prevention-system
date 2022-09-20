@extends('layouts.master')
@section('title', 'Edit Agency')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Agency</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard </a></li>
                                <li class="breadcrumb-item active" style="color: #74788d;">Edit Agency</li>
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

                             <?php
                                $user = \App\Models\User::find($agency->user_id);
                            ?>
                            
                            <form class="needs-validation" action="{{ route('agency.update', $agency->id) }}" method="post" novalidate="">
                                @method('PATCH')
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip01" class="form-label">Agency Name</label>
                                            <input type="text" class="form-control" id="validationTooltip01" placeholder="Enter Agency name" name="agency_name" value="{{ old('agency_name', $user->name) }}" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter agency name.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip02" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="validationTooltip02" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter E-mail Address" required="">
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
                                            <label for="validationTooltip03" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="validationTooltip03" placeholder="Enter Address" name="address" value="{{ old('address', $agency->address) }}" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter address.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip04" class="form-label">City</label>
                                            <input type="text" class="form-control" id="validationTooltip04" name="city" value="{{ old('city', $agency->city) }}" placeholder="Enter Present City" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter valid city.
                                            </div>
                                        </div>
                                    </div>                                               
                                </div>

                                <br>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip05" class="form-label">Zip
                                             Code </label>
                                            <input type="number" class="form-control" id="validationTooltip05" name="zip" value="{{ old('zip', $agency->zip) }}" placeholder="Enter Present Zip" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter valid zip code.
                                            </div>
                                        </div>
                                    </div>     

                                    <div class="col-md-6">
                                        <div class="mb-3 position-relative">
                                            <label for="validationTooltip06" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="validationTooltip06" placeholder="Enter Phone" name="phone" value="{{ old('phone', $agency->phone) }}" required="">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>

                                            <div class="invalid-tooltip">
                                                Please enter valid phone number.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">

                                    <div class="col-md-12">
                                        <br>
                                        <button class="btn btn-primary" style="margin-top: 6px !important; width: 100% !important" type="submit">Save Agency</button>
                                        
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