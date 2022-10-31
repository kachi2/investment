@extends('layouts.agency')
@section('content')

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Tasks</h4>
                                        <ol class="breadcrumb">
                                          
                                            <li class="breadcrumb-item active">Tasks</li>
                                        </ol>
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
                 
                    <div class="row">
                        @forelse ($tasks as  $task) 
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">                                    
                                    <div class="task-box">
                                        <div class="task-priority-icon"> @if($task->expires > now())<i class="fas fa-circle text-success">Active</i> @else <i class="fas fa-circle text-danger">Expired</i> @endif</div>
                                        <p class="text-muted float-end">
                                            
                                            Created: <span class="text-muted">{{$task->created_at->format('d/m/y')}}</span> 
                                            <span class="mx-1">·</span> 
                                            Expires: <span><i class="far fa-fw fa-clock"></i>{{Date("d/m/Y", strtotime($task->expires))}}</span>
                                        </p>
                                        <h5 class="mt-0">{{$task->heading}}</h5>
                                        <p class="text-muted mb-1">{{$task->content}}
                                        </p>
                                        <p class="text-muted text-end mb-1">{{$task->completion}}% Complete</p>
                                        <div class="progress mb-4" style="height: 4px;">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$task->completion}}%;" aria-valuenow="{{$task->completion}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            
                                            <ul class="list-inline mb-0 align-self-center">  
                                                <li class="list-item d-inline-block me-2">
                                                    <a class="" href="#">
                                                        <span class="text-muted "> No of Referrals: {{$task->referrals}} </span>
                                                    </a>
                                                </li>
                                                <li class="list-item d-inline-block me-2">
                                                    <a class="" href="#">
                                                        <span class="text-muted ">Bonus: {{'$'.$task->bonus}}</span>
                                                    </a>
                                                </li>     
                                                 <br>
                                                <small class="text-muted"> Task is assigned to {{$task->agent->email}} </small>    
                                                
                                            </ul>
                                        </div>                                        
                                    </div><!--end task-box-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                            
                        </div><!--end col-->
                        @empty
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">                                    
                                    <div class="task-box">
                                        <div class="task-priority-icon"> <i class="fas fa-circle text-success"></i> </div>
                                        <p> You dont have any task yet, check back later</p>
                                       
                                        <div class="progress mb-4" style="height: 4px;">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: %;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                                      
                                    </div><!--end task-box-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                            
                        </div>
                        @endforelse
                    </div><!--end row-->

                </div><!-- container -->



@endsection