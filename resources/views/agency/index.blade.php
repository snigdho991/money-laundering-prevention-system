@extends('layouts.master')
@section('title', 'Create Agency')

@section('content')
    <!-- ========================== Page Content ==================================== -->

    <!-- Transaction Modal -->
        <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <span id="isBanned" style="text-align: center;">
                            <p class="mb-1">Deactivated: <b><div class="text-primary" id="bday"> </div></b></p>
                            <p class="mb-1">Deactivation Reason: <b><div class="text-danger" id="banreason"> </div></b></p>

                            <form action="" method="post" id="unban-user">
                                @csrf
                                
                                <button class="btn btn-success" style="margin-top: 6px !important; width: 100% !important" type="submit">Activate Agency Again</button>
                            </form>
                        </span>

                        <span id="notBanned" style="text-align: center;">
                            <form class="needs-validation" action="" method="post" id="ban-user" novalidate="">
                                @csrf

                                    <div class="mb-3">
                                            
                                        <label for="validationTooltip01" class="form-label">Enter How Many Days For</label>
                                        <input type="number" min="1" class="form-control" id="validationTooltip01" placeholder="Enter Deactivation Period/Days" name="banned_until" value="{{ old('banned_until') }}" required="">
                                        {{-- <p>For suspending this agency permanently enter only <b>0</b></p> --}}
                                    
                                    </div>


                                    <div class="mb-3">
                                        
                                        <label for="validationTooltip02" class="form-label">Deactivation Reason</label>
                                        <input type="text" class="form-control" id="validationTooltip02" placeholder="Enter Deactivation Reason" name="banned_reason" value="{{ old('banned_reason') }}" required="">
                                
                                    </div>

                                    <button class="btn btn-danger" style="margin-top: 6px !important; width: 100% !important" type="submit">Deactivate</button>
                                </form>
                            </span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- end modal -->

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Agency List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Agency List</li>
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
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Suspension Status</th>
                                        <th>Suspension Report</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                @foreach($agencies as $agency)
                                    <?php
                                        $user = \App\Models\User::find($agency->user_id);
                                    ?>
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $agency->address }}</td>
                                        <td>{{ $agency->city }}</td>
                                        <td>{{ $agency->phone }}</td>
                                        <td>
                                            @if($user->banned_until && now()->lessThan($user->banned_until))
                                                
                                                <span class="badge rounded-pill bg-danger">Deactivated for <b>{{ now()->diffInDays($user->banned_until) + 1 }} </b> days</span>
                                            @else
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-banned="<?php if($user->banned_until && now()->lessThan($user->banned_until)){ echo now()->diffInDays($user->banned_until); } ?>" 
                                            data-banreason="<?php if($user->banned_until) { echo $user->banned_reason; } ?>" data-userid="{{ $user->id }}" data-bs-target=".transaction-detailModal">
                                                @if($user->banned_until)
                                                    Activate Again
                                                @else
                                                    Take Action
                                                @endif
                                            </button>
                                        </td>

                                        <td>
                                            
                                            <div class="inline" style="display: flex; gap: 5px;">
                                                <a class="btn btn-outline-info btn-sm edit" href="{{ route('agency.edit', $agency->id) }}" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                
                                                <form method="POST" action="{{ route('agency.destroy', $agency->id) }}">
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

@section('scripts')
    <script type="text/javascript">
        var banned;

        $('.transaction-detailModal').on('show.bs.modal', function(e) {
            var link           = $(e.relatedTarget),
                bday = banned  = link.data('banned'),
                banreason      = link.data('banreason'),
                userid         = link.data('userid'),
                modal          = $(this);
               
            if (bday) {
                $('#notBanned').hide();
                modal.find('#transaction-detailModalLabel').html('Suspension Details');
                modal.find('#bday').html('' + (bday*1+1) + ' days left');
                modal.find('#banreason').html(banreason);
                document.getElementById("unban-user").action = "/administrator/unban/" + userid + '/user';
            } else {
                modal.find('#transaction-detailModalLabel').html('Take Action');
                $('#isBanned').hide();
                $('#notBanned').show();
                document.getElementById("ban-user").action = "/administrator/ban/" + userid + '/user';
            }
            
            /*
            modal.find('.modal-title').html('Edit Product: ' + name);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #price').val(price);
            */
        });
    </script>
@endsection