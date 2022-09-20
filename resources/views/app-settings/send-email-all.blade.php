@extends('layouts.master')
@section('title', 'Send E-mail')

@section('content')
    <!-- ========================== Page Content ==================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Send E-mail To All Agencies</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard </a></li>
                                <li class="breadcrumb-item active" style="color: #74788d;">Send E-mail</li>
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
                            
                            <form class="needs-validation" id="agencymail" action="{{ route('email.to.agencies') }}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6" style="text-align: center;">
                                        <p><b>Enter your email details to send to all of your agencies.</b></p>

                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                
                                <br>
                                
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">E-mail Subject</label>
                                            <input type="text" class="form-control" placeholder="Enter E-mail Subject" name="email_subject">
                                            
                                        </div>
                                    </div>                        
                                </div>

                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">E-mail Body</label>
                                            <textarea class="summernote form-control" placeholder="Enter E-mail Details" name="email_body"></textarea>
                                            
                                        </div>
                                    </div>                        
                                </div>

                                <br>
                                
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <button type="submit" style="width: 25%;" class="btn btn-primary waves-effect">
                                            <i class="bx bx-send bx-spin font-size-16 align-middle me-2"></i> Send E-mail
                                        </button>
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

@section('styles')
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js" integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250,
            });
        });
    </script>
@endsection