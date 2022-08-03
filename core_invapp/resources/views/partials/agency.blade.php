<body>
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="{{route('agency.index')}}" class="logo">
                    <span>
                        <img src="{{asset('/logo.png')}}" alt="logo-small" class="logo-sm">
                    </span>
                    {{-- <span>
                        <img src="{{asset('/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                        <img src="{{asset('/logo.png')}}" alt="logo-large" class="logo-lg logo-dark">
                    </span> --}}
                </a>
                
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar style="background:#0c213a">
                <ul class="metismenu left-sidenav-menu">
                    <li class="menu-label mt-0">Main</li>
                    @if(agent_user()->is_admin == 0)
                    <li>
                        <a href="{{route('agency.index')}}"> <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                        
                    </li>
                    
                    <li>
                        <a href="{{route('agent.referral')}}"><i data-feather="lock" class="align-self-center menu-icon"></i><span>My Referrals</span></a>
                    </li> 
                    <li>
                        <a href="{{route('agency.task')}}"><i data-feather="lock" class="align-self-center menu-icon"></i><span>My Task</span></a>
                    </li>
                    @else
                    <li>
                        <a href="{{route('agency.admin.index')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{route('agency.admin.referals')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Agent Referrals</span></a>
                    </li>
                    <li>
                        <a href="{{route('agency.register')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Assign Task</span></a>
                    </li>
                    @endif
    
                    <hr class="hr-dashed hr-menu">
                    <li class="menu-label my-2">Income and Bonus</li>
                    @if(agent_user()->is_admin == 0)
                    <li>
                        <a href="{{route('agency.payment')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Payments</span></a>
                    </li>     
                    <li>
                        <a href="{{route('agency.salary')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Salary</span></a>
                    </li> 
                    @else
                    
                    <li>
                        <a href="{{route('agency.admin.salaries')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Salaries</span></a>
                    </li>
                    <li>
                        <a href="{{route('agency.admin.payments')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Hourly Payments</span></a>
                    </li>
                    @endif
                    <hr class="hr-dashed hr-menu">
                    <li class="menu-label my-2">Manage Account</li>   
                    @if(agent_user()->is_admin == 0)
                    <li>
                        <a href="{{route('agency.account')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span> My Account</span></a>
                    </li>   
                    @else
                    <li>
                        <a href="{{route('agency.account')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span> My Account</span></a>
                    </li> 
                    <li>
                        <a href="{{route('agency.register')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Add Agent</span></a>
                    </li>
                    <li>
                        <a href="{{route('admin.agent.list')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Manage Agent</span></a>
                    </li>
                    @endif   
                    <li>
                        <a href="{{route('agency.logout')}}" onclick="event.preventDefault(); document.getElementById('agency.logout').submit();"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Logout</span></a>
                    </li>       
                </ul>   <form action="{{route('agency.logout')}}" method="post" id="agency.logout">
                    @csrf
                </form>
            </div>
        </div>
        <!-- end left-sidenav-->

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom">    
                    <ul class="list-unstyled topbar-nav float-end mb-0">  
                         <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i data-feather="bell" class="align-self-center topbar-icon"></i>
                                <span class="badge bg-danger rounded-pill noti-icon-badge"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">
                            
                                <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                                    Notifications <span class="badge bg-primary rounded-pill"></span>
                                </h6> 
                                <div class="notification-menu" data-simplebar>
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">2 min ago</small>
                                        <div class="media">
                                            <div class="avatar-md bg-soft-primary">
                                                <i data-feather="shopping-cart" class="align-self-center icon-xs"></i>
                                            </div>
                                            <div class="media-body align-self-center ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark"></h6>
                                                <small class="text-muted mb-0">.</small>
                                            </div><!--end media-body-->
                                        </div><!--end media-->
                                    </a><!--end-item-->
                                </div>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <span class="ms-1 nav-user-name hidden-sm"></span>
                             
                                <img src="{{base_url()."images/".$user_profile}}" alt="profile" class="rounded-circle thumb-xs" />                                 
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user" class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings" class="align-self-center icon-xs icon-dual me-1"></i> Settings</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{route('agent.logout')}}" onclick="event.preventDefault(); document.getElementById('form1').submit()"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
                                <form id="form1" method="post" action="{{route('agent.logout')}}">
                                @csrf
                                </form>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
        
                    <ul class="list-unstyled topbar-nav mb-0">                        
                        <li>
                            <button class="nav-link button-menu-mobile">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li> 
                        @if(auth('agent')->user()->is_admin != 1)
                        <li class="creat-btn">
                            <div class="nav-link">
                     <span id="info">      Click on Process payment once the countdown completes. Your Next payment </span>   <span id="countdowns"> </span> 
                     &nbsp;   &nbsp;   &nbsp;
                     <span style="float:right"> 

                        <form method="post" action="{{route('agentProcess.payment')}}">
                            @csrf
                            <button class="btn btn-primary" id="processPay" hidden> Process Payment </button>
                        
                    </form>
                </span>  
                            </div>       
                                            
                        </li> @else 

                        <li>
                            <div class="nav-link">
                                <span>   Admin Page </span>
                            </div>
                        </li>
                        @endif
                                                
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->



