@extends('issuer.layout.base')

@section('content')

<div class="header-breadcrumbs">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Investor KYC</h1>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb-four" style="text-align: right;">
                    <ul class="breadcrumb">
                        <li><a href="{{url('issuer/dashboard')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                                <span>Dashboard</span></a></li>
                        <li class="active"><a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>Investor KYC</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Property Head Ends -->

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h4 class="mb-0">Investor KYC Details</h4>
                    </div>
                    <div class="card-body p-4">
    
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">First Name:</label>
                                <div>{{ $user->identity->first_name ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Last Name:</label>
                                <div>{{ $user->identity->last_name ?? 'N/A' }}</div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Date of Birth:</label>
                                <div>{{ $user->identity->dob ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Citizenship:</label>
                                <div>{{ $user->identity->citizenship ?? 'N/A' }}</div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Country Code:</label>
                                <div>{{ $user->identity->country_code ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">City:</label>
                                <div>{{ $user->identity->city_id ?? 'N/A' }}</div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Province:</label>
                                <div>{{ $user->identity->province ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Postal Code:</label>
                                <div>{{ $user->identity->postal_code ?? 'N/A' }}</div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Full Name:</label>
                                <div>{{ $user->name ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Email:</label>
                                <div>{{ $user->email ?? 'N/A' }}</div>
                            </div>
                        </div>
    
                        <div class="mb-4">
                            <label class="fw-bold">Residence:</label>
                            <div>{{ $user->identity->residence ?? 'N/A' }}</div>
                        </div>
    
                        <div class="row text-center">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Identification Document</label>
                                @if (!empty($user->issuer_pros_doc))
                                    <a href="{{ asset($user->issuer_pros_doc) }}" target="_blank" class="btn btn-outline-primary d-block mt-2">View Document</a>
                                @else
                                    <div class="text-danger mt-2">Not Uploaded</div>
                                @endif
                            </div>
    
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Address Proof Document</label>
                                @if (!empty($user->issuer_kyc_doc))
                                    <a href="{{ asset($user->issuer_kyc_doc) }}" target="_blank" class="btn btn-outline-primary d-block mt-2">View Document</a>
                                @else
                                    <div class="text-danger mt-2">Not Uploaded</div>
                                @endif
                            </div>
                        </div>
    
                    </div> <!-- End Card Body -->
                </div> <!-- End Card -->
            </div>
        </div>
    </section>
    
    
    <div class="alert-container">

    </div>

</div>
@endsection