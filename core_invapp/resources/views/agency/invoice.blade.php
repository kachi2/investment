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
                            <h4 class="page-title">Salary Invoice</h4>
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
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body invoice-head"> 
                        <div class="row">
                            <div class="col-md-5 align-self-center">                                                
                                <img src="{{asset('/logo.png')}}" alt="logo-small" class="logo-sm me-1" height="24">       
                                <p class="mt-2 mb-0 text-muted">If account is not paid within 72hrs contact billing team.</p>                                             
                            </div><!--end col-->    
                            <div class="col-md-7">
                                <ul class="list-inline mb-0 contact-detail float-end">                                                   
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-web"></i>
                                            <p class="text-muted mb-0">https://mazeoptions.com</p>
                                            <p class="text-muted mb-0">billing@mazeoptions.com</p>
                                        </div>                                                
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-phone"></i>
                                            <p class="text-muted mb-0">+123 123456789</p>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                           
                                            <p class="text-muted mb-0"> @if($salary->is_approved == 1)<span class="btn btn-success">Invoice Paid</span>  @else <span class="btn btn-danger">Invoice Unpaid</span> @endif</p>
                                        </div>
                                    </li>
                                </ul>
                            </div><!--end col-->    
                        </div><!--end row-->     
                    </div><!--end card-body-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="">
                                    <h6 class="mb-0"><b>Invoice Date :</b> {{$salary->created_at}}</h6>
                                    <h6><b>Invoice Ref:</b> #{{$salary->ref}}</h6>
                                </div>
                            </div><!--end col--> 
                            <div class="col-md-3">                                            
                                <div class="float-left">
                                    <address class="font-13">
                                        <h6>Payee Details:</h6>
                                    <p class="text-muted  mb-0">{{agent_user()->name}}.</p> 
                                    <p class="text-muted  mb-0">{{agent_user()->email}}.</p>  
                                    <p class="text-muted  mb-0">{{agent_user()->phone}}.</p> 
                                     
                                    </address>
                                </div>
                            </div><!--end col--> 
                            <div class="col-md-3">
                                <div class="">
                                    <address class="font-13">
                                        <h6>Payment Details:</h6>
                                        <p class="text-muted  mb-0"> {{agent_user()->payment_method}}.</p> 
                                        <p class="text-muted  mb-0"> {{agent_user()->wallet_address}}.</p> 
                                    </address>
                                </div>
                            </div> <!--end col-->                       
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive project-invoice">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Ref</th>
                                                <th>Payment</th> 
                                                <th>Subtotal</th>
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>{{$salary->ref}}</td>
                                                <td>Salary Payment</td>
                                                <td>{{$salary->amount}}</td>
                                            </tr><!--end tr-->
                                            <tr>                                                        
                                                <td colspan="2" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Sub Total</b></td>
                                                <td class="border-0 font-14 text-dark"><b>{{$salary->amount}}</b></td>
                                            </tr><!--end tr-->
                                            <tr>
                                                <th colspan="2" class="border-0"></th>                                                        
                                                <td class="border-0 font-14 text-dark"><b>Tax Rate</b></td>
                                                <td class="border-0 font-14 text-dark"><b>7.5%</b></td>
                                            </tr><!--end tr-->
                                            <tr class="bg-black text-white">
                                                <th colspan="2" class="border-0"></th>                                                        
                                                <td class="border-0 font-14"><b>Total</b></td>
                                                <td class="border-0 font-14"><b>{{moneyFormat($salary->total, 'USD')}}</b></td>
                                            </tr><!--end tr-->
                                        </tbody>
                                    </table><!--end table-->
                                </div>  <!--end /div-->                                          
                            </div>  <!--end col-->                                      
                        </div><!--end row-->
                        <div class="row ">
                            <div class="col-lg-6">
                                <h5 class="mt-4">Terms And Condition :</h5>
                                <ul class="ps-1">
                                    <li><small class="font-12">All accounts are to be paid within 72hrs from receipt of invoice. </small></li>
                                    <li><small class="font-12"> If account is not paid within 72hrs contact billing team.</small></li>                                            
                                </ul>
                            </div> 
                        </div><!--end row-->
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none">
                                    <a href="javascript:window.print()" class="btn btn-soft-info btn-lg">Print</a>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!-- container -->
@endsection