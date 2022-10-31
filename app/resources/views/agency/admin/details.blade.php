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
                            <h4 class="page-title">{{$agent->name}} Details</h4>
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

        <div class="row">
            <div class="col-12">
                <div class="card">                              
                    <div class="card-body">
                        <div class="dastone-profile">
                            <div class="row">
                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                    <div class="dastone-profile-main">
                                        <div class="dastone-profile-main-pic">
                                            <span class="dastone-profile_main-pic-change">
                                                <i class="fas fa"></i>
                                            </span>
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">{{$agent->name}}</h5>                                                        
                                            <p class="mb-0 dastone-user-name-post">{{strtoupper($agent->city.','.$agent->country)}}</p>                                                        
                                        </div>
                                    </div>                                                
                                </div><!--end col-->
                                <div class="col-lg-6 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : {{$agent->phone}}</li>
                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{$agent->email}}</li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end f_profile-->                                                                                
                    </div><!--end card-body-->          
                </div> <!--end card-->    
            </div><!--end col-->
        </div><!--end row-->
        <div class="pb-4">
            <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="Profile_Post_tab" data-bs-toggle="pill" href="#Profile_Post">Account Information</a>
                </li>
                
            </ul>        
        </div><!--end card-body-->
       
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="Profile_Post" role="tabpanel" aria-labelledby="Profile_Post_tab">
                       
                        <div class="row">
                            
                            <div class="col-lg-6 col-xl-6">
                                <form method="post" action="{{route('UpdateAccount')}}" enctype="multipart/form-data">
                                    @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">                      
                                                <h4 class="card-title">Personal Information</h4>                      
                                            </div><!--end col-->                                                       
                                        </div>  <!--end row-->                                  
                                    </div><!--end card-header-->
                                    <div class="card-body">                       
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Name</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la"></i></span>
                                                <input class="form-control" name="name" type="text" value="{{agent_user()->name}}" readonly>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Phone</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la"></i></span>
                                                    <input type="tel" class="form-control" value="{{agent_user()->phone}}" placeholder="Phone" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Email Address</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la"></i></span>
                                                    <input type="email" class="form-control" value="{{agent_user()->email}}" placeholder="Email" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Address</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la"></i></span>
                                                    <input type="text" class="form-control" name="city" value="{{agent_user()->city}}" placeholder="Address" aria-describedby="basic-addon1" readonly >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">State</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la"></i></span>
                                                    <input type="text" class="form-control" name="state" value="{{agent_user()->state}}" placeholder="Email" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Country</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la"></i></span>
                                                    <input type="text" class="form-control" name="country" value="{{agent_user()->country}}" placeholder="Email" aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Profile Image</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="las la-"></i></span>
                                                   <img src="{{base_url().'images/'.$agent->img}}" width="100px" height="100px">
                                                </div>
                                            </div>
                                        </div>
                                        
                                                                                          
                                    </div>                                            
                                </div>
                            </form>
                            </div> <!--end col--> 
                        
                             

                            <div class="col-lg-6 col-xl-6">
                                <form method="post" action="{{route('admin.changePass',encrypt($agent->id))}}">
                                    @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Change Password</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body"> 
                                       
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">New Password</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" name="password" type="password" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Confirm Password</label>
                                            <div class="col-lg-9 col-xl-8">
                                                <input class="form-control" name="password_confirmation" type="password" placeholder="Re-Password">
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-xl-8 offset-lg-3">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Change Password</button>
                                               
                                            </div>
                                        </div>   
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </form> 
                            </div> <!-- end col -->   
                                                                                                  
                        </div><!--end row-->
                    </div><!--end tab-pane-->
                </div><!--end tab-content-->
            </div><!--end col-->
        </div><!--end row-->
   
    </div><!-- container -->
@endsection