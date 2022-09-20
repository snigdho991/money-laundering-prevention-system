<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <?php
                $find_logo = \DB::table('site_settings')->where('id', 1)->first();
            ?>
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22"> 

                    @if(Auth::user()->hasRole('Administrator'))
                        <img src="{{ asset('assets/uploads/logo/'.$find_logo->logo) }}" style="background: #fff;border-radius: 2px;" class="editPro" alt="" height="25" width="95">
                    @else
                        <?php
                            $auth = Auth::user();
                            $find_agency = \App\Models\Agency::where('user_id', $auth->id)->first();
                        ?>
                        @if($find_agency->logo == null)
                            <img src="{{ asset('assets/uploads/logo/'.$find_logo->logo) }}" style="background: #fff;border-radius: 2px;" class="editPro" alt="" height="25" width="95">
                        @else
                            <img src="{{ asset('assets/uploads/agency-logo/'.$find_agency->logo) }}" style="background: #fff;border-radius: 2px;" class="editPro" alt="" height="25" width="95">
                        @endif
                    @endif
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-lights">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-light.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.svg') }}" alt="" height="22"> 
                        @if(Auth::user()->hasRole('Administrator'))
                            <img src="{{ asset('assets/uploads/logo/'.$find_logo->logo) }}" style="background: #fff;border-radius: 2px;" class="editPro" alt="" height="25" width="95">
                        @else
                            <?php
                                $auth = Auth::user();
                                $find_agency = \App\Models\Agency::where('user_id', $auth->id)->first();
                            ?>
                            @if($find_agency->logo == null)
                                <img src="{{ asset('assets/uploads/logo/'.$find_logo->logo) }}" style="background: #fff;border-radius: 2px;" class="editPro" alt="" height="25" width="95">
                            @else
                                <img src="{{ asset('assets/uploads/agency-logo/'.$find_agency->logo) }}" style="background: #fff;border-radius: 2px;" class="editPro" alt="" height="25" width="95">
                            @endif
                        @endif
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>


            {{-- <?php
                if(Auth::user()->role == 'Master Administrator'){
                    $notifications = \App\Models\Notification::where('status', 'unseen')->where('notification_to_type', 'Master Administrator')->orderBy('created_at', 'desc')->take(5)->get();
                    $notifications_count = \App\Models\Notification::where('status', 'unseen')->where('notification_to_type', 'Master Administrator')->count();

                } else if(Auth::user()->role == 'Client') {
                    $notifications = \App\Models\Notification::where('status', 'unseen')->where('notification_to_type', 'Client')->where('notification_to', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                    $notifications_count = \App\Models\Notification::where('status', 'unseen')->where('notification_to_type', 'Client')->where('notification_to', Auth::id())->count();
                } else {
                    $notifications = \App\Models\Notification::where('status', 'unseen')->where('notification_to_type', 'Agency')->where('notification_to', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
                    $notifications_count = \App\Models\Notification::where('status', 'unseen')->where('notification_to_type', 'Agency')->where('notification_to', Auth::id())->count();
                }
            ?>


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    @if($notifications_count > 0)
                        <span class="badge bg-danger rounded-pill">
                            {{ $notifications_count }}
                        </span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ url('/notifications') }}" class="small"> View All</a>
                                </div>
                            </div>
                        </div>

                    @if($notifications_count > 0)
                        @foreach($notifications as $notification)
                        <?php
                            $user_avatar = App\Models\User::where('id', $notification->notification_from)->first();
                            $url = '/';
                            /* if (isset($notification->project_id)) {
                                $project_id = \Modules\Cms\Entities\Project::where('project_id', $notification->project_id)->first()->id;
                                if ($notification->type == "ProjectCreation") $url = '/backend/project/pending/' . $project_id;
                                else if ($notification->type == "ProjectApproval") $url = '/backend/project/approved/' . $project_id;
                                else if ($notification->type == "ProjectClientApproval") $url = '/backend/project/accepted/' . $project_id;
                                else if ($notification->type == "ProjectCompanyFile") $url = '/backend/project/approved/' . $project_id;
                                else if ($notification->type == "ProjectAdminFile") $url = '/backend/project/approved/' . $project_id;
                            } */
                        ?>
                        
                            <div data-simplebar style="max-height: 230px;">
                                <a href="{{ url('/notifications') }}" class="text-reset notification-item">
                                    <div class="media">
                                        @if($user_avatar->hasRole('Client'))
                                            <?php
                                                $user_cus = \App\Models\Customer::where('user_id', $user_avatar->id)->first();
                                            ?>
                                            @if($user_cus->photo != null)
                                                <img src="{{ asset('/assets/uploads/customer/'.$user_cus->photo) }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            @else
                                                <img src="{{ asset('/assets/images/default/avatar.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            @endif
                                        @else
                                            @if($user_avatar->profile_photo_path != null)
                                                <img src="{{ asset('/assets/uploads/users/'.Auth::user()->profile_photo_path) }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            @else
                                                <img src="{{ asset('/assets/images/default/avatar.jpg') }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            @endif
                                        @endif
                                            
                                        <div class="media-body">
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1 notification-msg">{{ $notification->message }}</p>
                                                <p class="mb-0 notification-time"><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div data-simplebar style="max-height: 230px;">
                            <div class="text-reset notification-item">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="font-size-14 text-muted">
                                            <p class="mb-1" style="color: #495057; font-weight: 450;">No new notification!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ url('/notifications') }}">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">@if($notifications_count > 0) View More.. @else View All.. @endif</span> 
                            </a>
                        </div>
                    </div>
            </div> --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ url('/user/profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item d-block" href="{{ url('/user/profile') }}"><span class="badge bg-success float-end">new</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                    
                    <div class="dropdown-divider"></div>                    

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-danger dropdown-item">
                            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>

                            <span key="t-logout">
                                {{ __('Log out') }}
                            </span>                            
                        </button>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>

        </div>
    </div>
</header>