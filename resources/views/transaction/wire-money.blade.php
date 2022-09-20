@extends('layouts.master')
@section('title', 'Send Wire Money')

@section('content')
    
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Send Wire Money</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Send Wire Money</li>
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
                            <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques" role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                                <i class="bx bx-question-mark d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Company</p>
                            </a>
                            <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab" aria-controls="v-pills-privacy" aria-selected="false"> 
                                <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Amount</p>
                            </a>
                            <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab" aria-controls="v-pills-support" aria-selected="false">
                                <i class="bx bx-user-pin d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Beneficiary</p>
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('transaction.send.wiremoney') }}" method="post" class="needs-validation" novalidate="">
                                @csrf

                                    <input type="hidden" name="customer_id" value="{{ $id }}">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @php 
                                            $companies = \App\Models\Company::where('status', 1)->where('agency_user_id', Auth::id())->get();
                                        @endphp
                                        <div class="tab-pane fade active show" id="v-pills-gen-ques" role="tabpanel" aria-labelledby="v-pills-gen-ques-tab">
                                            <h4 class="card-title mb-3">Select your preferred company</h4>
                                            <p class="card-title-desc">
                                                You have total  <b><code class="highlighter-rouge">{{ $companies->count() }}</code></b> total companies. You can send wire money via one of these company at a time.
                                            </p>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Company List</label>
                                                        
                                                        <select class="form-control select2" id="validationTooltip01" name="company_id" required="">
                                                            
                                                            <option value="">Select</option>
                                                            <optgroup label="All Agenicies">
                                                                @foreach($companies as $company)
                                                                    <option value="{{ $company->id }}">
                                                                        {{ $company->company_name }}
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                            
                                                        </select>
                                                        <div class="valid-tooltip">
                                                            Looks good!
                                                        </div>

                                                        <div class="invalid-tooltip">
                                                            Please select an company.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel" aria-labelledby="v-pills-privacy-tab">
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
                                            <h4 class="card-title mb-3">Introduce Beneficiary</h4>
                                            <p class="card-title-desc">
                                                Enter a beneficiary name who will receive the money.
                                            </p>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">
                                                        <label for="validationTooltip03" class="form-label">Enter Beneficiary</label>
                                                        <input type="text" class="form-control" id="validationTooltip03" name="beneficiary" value="{{ old('beneficiary') }}" placeholder="Enter Beneficiary" required="">
                                                        <div class="valid-tooltip">
                                                            Looks good!
                                                        </div>

                                                        <div class="invalid-tooltip">
                                                            Please enter a valid beneficiary.
                                                        </div>
                                                    </div>
                                                </div>   
                                            </div>

                                            <br>
                                            <button class="btn btn-primary" style="width: 100% !important" type="submit">Send Wire Money</button>  
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