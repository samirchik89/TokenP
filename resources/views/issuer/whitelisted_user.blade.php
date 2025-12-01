@extends('issuer.layout.base')
@section('content')
    <!-- Start Page Content here -->
    <div class="content-page-inner">

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Whitelisted Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb-four" style="text-align: right;">
                            <ul class="breadcrumb">
                                <li><a href="{{ url('issuer/dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-box">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                            </path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg> <span>Dashboard</span></a></li>
                                <li class="active"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2"
                                                ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                        </svg> <span>Whitelisted Users</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->

        {{-- <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12" style="text-align:right;">
                        <a href="{{ url('/issuer/whitelist_users') }}" class="btn btn-primary">Whitelisted users</a>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="content">
            <!-- Start container-fluid -->
            <div class="container-fluid wizard-border">
                <!-- start  -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <div>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>User</th>
                                        <th>Wallet address</th>
                                        <th>Property Name</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($whitelistRequests as $index => $value)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$value->user->name}}</td>
                                        <td>{{$value->wallet_address}}</td>
                                        <td>{{$value->property->propertyName}}</td>
                                        <td>{{$value->status}}</td>
                                        {{-- <td>
                                            <!-- <a href="{{ url('issuer/update_whitelist_request', [$value->id, 'Approved']) }}" class="btn btn-success">Approve</a> -->
                                             <button class="btn btn-success action-button" onclick="ApproveInvestor('{{$value->id}}', '{{$value->wallet_address}}')">Approve</button>
                                             <button class="btn btn-danger action-button" onclick="RejectInvestor('{{$value->id}}', '{{$value->user->eth_address}}')">Reject</button>
                                            <!-- <a href="{{ url('issuer/update_whitelist_request', [$value->id, 'null', 'Cancelled']) }}" class="btn btn-danger">Reject</a> -->
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->
        <!-- Footer Start -->
          <footer class="footer">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex flex-wrap justify-content-between align-content-center">
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                            <p>Copyright © <script>document.write(new Date().getFullYear());</script> {{ $project_name }}. All rights reserved.</p>
                        </div>
                      </div>
                  </div>
              </div>
          </footer>
        <!-- end Footer -->

    </div>
    <!-- END content-page -->
@endsection
<!-- <script src="{{ asset('js/whitelist.js') }}"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ethers@5.6.2/dist/ethers.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
