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

                            
                     
                        @foreach ($tasks as  $task) <div class="col-lg-6">

                        
                            <div class="card">
                                <div class="card-body">                                    
                                    <div class="task-box">
                                        <div class="task-priority-icon"> @if($task->expires > now())<i class="fas fa-circle text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</div>
                                        <p class="text-muted float-end">
                                            
                                            <span class="text-muted">{{$task->created_at->format('h:m:a')}}</span> 
                                            <span class="mx-1">·</span> 
                                            <span><i class="far fa-fw fa-clock"></i>{{$task->created_at->format('M d')}}</span>
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
                                                        <i class="mdi mdi-format-list-bulleted text-success font-15"></i>
                                                        <span class="text-muted fw-bold">{{$task->completion}}/100</span>
                                                    </a>
                                                </li>
                                                <li class="list-item d-inline-block">
                                                    <a class="" href="#">
                                                        <i class="mdi mdi-comment-outline text-primary font-15"></i>
                                                        <span class="text-muted fw-bold">@if($task->expires > now())Active @else Expired @endif</span>
                                                    </a>                                                                               
                                                </li>
                                                
                                            </ul>
                                        </div>                                        
                                    </div><!--end task-box-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                            
                        </div><!--end col-->

                        @endforeach
                    </div><!--end row-->

                </div><!-- container -->



@endsection