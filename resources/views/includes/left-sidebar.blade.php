<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
        @if(Auth::check())
            <ul class="metismenu list-unstyled" id="side-menu">
                
                @if(Auth::user()->hasRole('Administrator'))
                    <li class="menu-title" key="t-menu">Dashboard Stuff</li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-calendar">Dashboard</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">Settings</li>

                        <li>
                            <a href="{{ route('send.email') }}" class="waves-effect">
                                <i class="bx bx-mail-send"></i>
                                <span key="t-calendar">Send E-mail</span>
                            </a>
                        </li>    
                    
                        <li>
                            <a href="{{ route('apps.settings') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Change Site Logo</span>
                            </a>
                        </li>

                        <li>
                            <a href=" {{ url('/user/profile') }} " class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Email & Password</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">Agency Tools</li>
                        <li>
                            <a href="{{ route('agency.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Agency List</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('agency.create') }}" class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Add Agency</span>
                            </a>
                        </li>


                    <li class="menu-title" key="t-apps">Administrator Tools</li>
                        <li>
                            <a href="{{ route('admin.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Administrator List</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.create') }}" class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Add User Administrator</span>
                            </a>
                        </li>

                @elseif(Auth::user()->hasRole('Agency'))
                    <li class="menu-title" key="t-menu">Dashboard Stuff</li>
                        <li>
                            <a href="{{ route('agency.dashboard') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-calendar">Dashboard</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">Settings</li>

                        <li>
                            <a href="{{ route('set.monthly.limit') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Set Monthly Limit</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('change.agency.logo') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Change Agency Logo</span>
                            </a>
                        </li>

                        <li>
                            <a href=" {{ url('/user/profile') }} " class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Email & Password</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">Company Tools</li>
                        <li>
                            <a href="{{ route('company.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Company List</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('company.create') }}" class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Add Company</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">Customer Tools</li>
                        <li>
                            <a href="{{ route('customer.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-calendar">Customer List</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer.create') }}" class="waves-effect">
                                <i class="bx bx-task"></i>
                                <span key="t-calendar">Add Customer</span>
                            </a>
                        </li>
                @endif

                    <li class="menu-title" key="t-apps">Transaction Tools</li>
                    
                        <li>
                            <a href="{{ route('transaction.status.cheque') }}" class="waves-effect">
                                <i class="bx bx-check-shield"></i>
                                <span key="t-calendar">Cheque</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('transaction.status.wire') }}" class="waves-effect">
                                <i class="bx bx-money"></i>
                                <span key="t-calendar">Wire Money</span>
                            </a>
                        </li>

                    <li class="menu-title" key="t-apps">Report Stuffs</li>
                        <li>
                            <a href="{{ route('report.this.week') }}" class="waves-effect">
                                <i class="mdi mdi-calendar-weekend"></i>
                                <span key="t-calendar">This Week</span>
                            </a>
                        </li>
                    
                        <li>
                            <a href="{{ route('report.this.month') }}" class="waves-effect">
                                <i class="mdi mdi-clock-start"></i>
                                <span key="t-calendar">This Month</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('report.this.year') }}" class="waves-effect">
                                <i class="mdi mdi-table-clock"></i>
                                <span key="t-calendar">This Year</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('report.advanced.search') }}" class="waves-effect">
                                <i class="bx bx-aperture"></i>
                                <span key="t-calendar">Advanced Search</span>
                            </a>
                        </li>
            </ul>
            
        @endif
        </div>
        <!-- Sidebar -->
    </div>
    
</div>