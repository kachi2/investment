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
                            <h4 class="page-title">Overview</h4>
                            
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="day-name" id="Day_Name">Today:</span>&nbsp;
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
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Active Referrals</p>
                                <h3 class="m-0">{{count($referals)}}</h3>
                                <p class="mb-0 text-truncate text-muted"><span class="text-success"></span> Active in Last 14 Days</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i data-feather="layers" class="align-self-center text-muted icon-md"></i>  
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body--> 
                </div><!--end card--> 
            </div> <!--end col--> 
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">                                                
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Total Referrals</p>
                                <h3 class="m-0">{{count($referals)}}</h3>
                                <p class="mb-0 text-truncate text-muted"><span class="badge-soft-success">5</span> In last 14 days</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i data-feather="check-square" class="align-self-center text-muted icon-md"></i>  
                                </div>
                            </div> 
                        </div>
                    </div><!--end card-body--> 
                </div><!--end card--> 
            </div> <!--end col-->                         
            
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">                                                
                            <div class="col">
                                <p class="text-dark mb-1 font-weight-semibold">Referral Bonus</p>
                                <h3 class="m-0">{{'$'.$referals->sum('bonus')}}</h3>
                                <p class="mb-0 text-truncate text-muted"><span class="text-dark">{{'$'.$pending->sum('bonus')}}</span> Unclaimed Bonus</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i data-feather="dollar-sign" class="align-self-center text-muted icon-md"></i>  
                                </div>
                            </div> 
                        </div>
                    </div><!--end card-body--> 
                </div><!--end card--> 
            </div> <!--end col-->                               
        </div><!--end row-->

        

        <div class="row">                        
            <div class="col-12">
                <div class="card">  
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">                      
                                <h4 class="card-title">All Referrals</h4>                      
                            </div><!--end col-->
                         
                        </div>  <!--end row-->                                  
                    </div><!--end card-header-->                                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Registered</th>
                                        <th>Last Login</th>
                                        <th>Status</th>
                                        <th>Deposit Status</th>
                                        <th>Deposit Bonus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($referals as $ref)
                                    <tr>
                                        <td>{{$ref->user->name}}</td>
                                        <td>{{$ref->user->email}}
                                        </td>
                                        <td>{{$ref->user->created_at}}</td>
                                        <td>{{$ref->user->last_login}}</td>
                                        <td>@if($ref->user->status == 'active')<span class="badge badge-md badge-boxed  badge-soft-success">{{$ref->user->status}}</span> @else 
                                            <span class="badge badge-md badge-boxed  badge-soft-danger">{{$ref->user->status}}</span> @endif</td>
                                        
                                        <td>@if($ref->user->deposit) <span class="badge badge-md badge-boxed  badge-soft-success">Deposited</span> @else <span class="badge badge-md badge-boxed  badge-soft-danger">No Deposit Found</span> @endif</td>
                                        <td>@if($ref->user->deposit) {{('$'.$ref->user->deposit[0]->amount/100 *5)}}</td>@else <td></td>@endif </td>
                                        <td><small>@if($ref->status == 0 )  <a href="{{route('referal.claimBonus',encrypt($ref->id))}}"> Claim Bonus </a> @else  @endif</td>
                                            
                                           
                                    </tr>
                                    @empty
                                        
                                    @endforelse
                                                                                                                                  
                                </tbody>
                            </table>
                                                                           
                        </div><!--end table-responsive--> 
                    </div><!--end card-body-->                                                                                                        
                </div><!--end card-->
            </div><!--end col-->     
        </div><!--end row-->

    </div><!-- container -->

    

@endsection