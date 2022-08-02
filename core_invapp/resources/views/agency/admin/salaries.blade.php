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
                            <h4 class="page-title">Salary</h4>
                            
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
                    <div class="card-header">
                        <h4 class="card-title">Salary Payment</h4>
                        <p class="text-muted mb-0">Approve generated invoice and mark payment, click on invoice for more information</p>
                     
                    </div><!--end card-header-->
                    <div class="card-body">
                        <table id="row_callback" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#Ref</th>
                                <th>Agent Email</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Wallet Address</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>


                            <tbody>
                         
                           @foreach ($payments as $pay )
                           
                           <tr>
                                <td>{{$pay->ref}}</td>
                                <td>  {{$pay->agent->email}}</td>
                                <td>{{$pay->amount}}</td>
                                <td>{{$pay->payment_method}}</td>
                                <td>{{$pay->wallet_address}}</td>
                                <td>{{$pay->created_at}}</td>
                               
                                <td> @if($pay->is_approved == 1)<span class="badge bg-success">Invoice Paid</span>  @elseif($pay->is_approved == 0) <span class="badge bg-info">Invoice Pending</span>  @else <span class="badge bg-danger">Invoice Cancelled</span> @endif</td>
                                <td> <a href="{{route('agency.admin.invoice', encrypt($pay->id))}}" style="color:green"> View Invoice </a></td>
                            </tr>
                            @endforeach
                           
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

      

    </div><!-- container -->


    <div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Salary Invoice</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="card-body p-0 auth-header-box">
                        <div class="">
                            <div class="row">
                                <div class="col-md-5 col-lg-3">
                                    <h6>Payee Details:</h6>
                                    <p class="text-muted  mb-0">{{agent_user()->name}}.</p> 
                                    <p class="text-muted  mb-0">{{agent_user()->email}}.</p>  
                                    <p class="text-muted  mb-0">{{agent_user()->phone}}.</p>  
                                </div>
                                <div class="col-md-2 col-lg-3">
                                </div>
                            <div class="col-md-5 col-lg-3">
                                <h6>Payee Address:</h6>
                                <p class="text-muted  mb-0"> {{agent_user()->city}}.</p> 
                                <p class="text-muted  mb-0"> {{agent_user()->state}}.</p>  
                                <p class="text-muted  mb-0"> {{agent_user()->country}}.</p>  
                            </div>
                      
                        </div>
                             
                        </div>
                    </div>
                    <div class="card-body p-0">
                         <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">                                        
                                <form class="form-horizontal auth-form" action="{{route('salary.invoice')}}" method="post">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="username">Payment Method</label>
                                        <div class="input-group">                                                                                         
                                            <select class="form-control" name="payment_method"> 
                                                <option value="btc"> {{strtoupper(agent_user()->payment_method)}}</option>
                                                
                                            </select>
                                        </div>                                    
                                    </div><!--end form-group--> 
        
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="userpassword">Payment Wallet</label>                                            
                                        <div class="input-group">                                  
                                            <input type="text" class="form-control" name="wallet_address" value="{{agent_user()->wallet_address}}"  placeholder="Enter Payment Address" readonly>
                                        </div>  
                                        <small> To change address, update account details</small>                             
                                    </div><!--end form-group--> 

                                    <div class="form-group mb-2">
                                        <label class="form-label" for="userpassword">Amount</label>                                            
                                        <div class="input-group">                                  
                                            <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                                        </div>  
                                        
                                        <small>All accounts are be paid within 48hrs from receipt of invoice.<br>
                                            If account is not paid within 72hrs contact support team</small>                             
                                    </div><!--end form-group--> 
                                    <br>
                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Generate Invoice<i class="fas fa-sign-in-alt ms-1"></i></button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->                           
                                </form><!--end form-->
                            </div>
                        </div>
                    </div><!--end card-body-->                                              
                </div><!--end modal-body-->
                
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->





@endsection