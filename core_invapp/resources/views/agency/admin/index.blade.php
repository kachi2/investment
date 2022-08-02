@extends('layouts.agency')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Analytics</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Summary of your account</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i data-feather="download" class="align-self-center icon-xs"></i>
                            </a>
                        </div><!--end col-->  
                    </div><!--end row-->                                                              
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-9">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Total Registered Agents</p>
                                        <h3 class="m-0">{{count($registered_users)}} Agents</h3>
                                        <p class="mb-0 text-truncate text-muted">
                                            <span class="text-success">{{count($users)}} Users</span> Registered in 14 days</p>
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                    <div class="col-md-6 col-lg-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">                                                
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Total Payments</p>
                                        <h3 class="m-0">{{'$'.$payments}}</h3>
                                        <p class="mb-0 text-truncate text-muted"><span class="text-success">{{'$'.$payment}}</span> Paid in 14 Days</p>
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                    <div class="col-md-6 col-lg-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">                                                
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Total Referrals</p>
                                        <h3 class="m-0">{{count($referrals)}}</h3>
                                        <p class="mb-0 text-truncate text-muted"><span class="text-danger">{{count($referral)}}</span> Referrals in last 14 Days</p>
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                    <div class="col-md-6 col-lg-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">  
                                        <p class="text-dark mb-0 fw-semibold">Paid Salary</p>                                         
                                        <h3 class="m-0">{{$salary}}</h3>
                                        <p class="mb-0 text-truncate text-muted"><span class="text-success">{{$salaries}}</span>Pending Salary</p>
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col-->                               
                </div><!--end row-->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">                      
                                <h4 class="card-title">Hourly Payments</h4>                      
                            </div><!--end col-->                                        
                        </div>  <!--end row-->                                  
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-top-0">Date</th> 
                                        <th class="border-top-0">User</th>                                                        
                                        <th class="border-top-0">Reference</th>
                                      
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">Earnings</th>
                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                                    @foreach ($paymentx as $pay )
                                    <tr>                                                
                                        <td>{{$pay->created_at->format('d/m/y h:m:i')}}</td> 
                                        <td>{{$pay->agent->email}}</td>                                                           
                                        <td>{{$pay->ref}}</td>
                                      
                                       <td class="text-success">Paid</td>
                                       
                                        <td>{{$pay->amount}}</td>
                                    </tr>    
                                    @endforeach                    
                                </tbody>
                            </table> <!--end table-->                                               
                        </div><!--end /div-->
                    </div><!--end card-body--> 
                </div><!--end card--> 
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card overflow-hidden"> 
                    <div class="card-body">                                    
                        <div class="row">
                            <div class="col">
                                <div class="media">
                                    <img src="assets/images/money-beg.png" alt="" class="align-self-center" height="40">
                                    <div class="media-body align-self-center ms-3"> 
                                        <h6 class="m-0 font-20">{{'$'.$wallet}}</h6>
                                        <p class="text-muted mb-0">Total Agents Wallet</p>   
                                                                                                                                                                               
                                    </div><!--end media body-->
                                </div><!--end media-->
                            </div><!--end col-->  
                                                                 
                        </div><!--end row-->
                    </div><!--end card-body-->
                   
                </div> <!--end card-->  
                <div class="card">   
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">                      
                                <h4 class="card-title">Activity</h4>                      
                            </div><!--end col-->
                            <div class="col-auto"> 
                                <div class="dropdown">
                                    <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="las la-angle-down ms-1"></i>
                                    </a>
                                </div>          
                            </div><!--end col-->
                        </div>  <!--end row-->                                  
                    </div><!--end card-header-->                                              
                    <div class="card-body"> 
                        <div class="analytic-dash-activity" data-simplebar>
                            <div class="activity">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="border-top-0">Login Ip</th>                                                            
                                                <th class="border-top-0">Location</th>
                                              
                                                <th class="border-top-0">Date</th>
                                                <th class="border-top-0">Browser</th>
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody>
                                            @foreach ($activities as $act )
                                            <tr>                                                
                                                <td><small> {{$act->login_ip}}</small></td>                                                            
                                                <td><small>USA</small></td>
                                                <td><small>{{$act->created_at->format('h:m:i d/m/y')}}</small></td>
                                                <td><small>{{substr($act->browser, 0,23)}}</small></td>
                                            </tr>    
                                            @endforeach                    
                                        </tbody>
                                    </table> <!--end table-->                                               
                                </div><!--end /div-->
                                                                                                                                                                    
                            </div><!--end activity-->
                        </div><!--end analytics-dash-activity-->
                    </div>  <!--end card-body-->                                     
                </div><!--end card--> 
            </div><!-- end col-->    
        </div><!--end row-->
    </div><!-- container -->
    
@endsection