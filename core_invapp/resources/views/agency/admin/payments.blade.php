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
                            <h4 class="page-title">Payments</h4>
                            
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
            <div class="col-12">
                <div class="card">
                   
                    </div><!--end card-header-->
                    <div class="card-body">
                        <table id="row_callback" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#Ref</th>
                                <th>Agent Email</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Period</th>
                                <th>Date</th>
                            </tr>
                            </thead>


                            <tbody>
                         
                           @foreach ($payments as $pay )
                           <tr>
                                <td>{{$pay->ref}}</td>
                                <td>{{$pay->agent->email}}</td>
                                <td>{{$pay->amount}}</td>
                               
                                <td> <span class="badge bg-success">Paid</span></td>
                                <td> 1 hour</td>
                                <td>{{$pay->created_at}}</td>
                                
                            </tr>
                            @endforeach
                           
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

      

    </div><!-- container -->



@endsection