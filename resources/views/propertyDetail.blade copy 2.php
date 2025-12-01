@extends($layout)

@section('content')
    <style>
        /* Modern CSS Variables */
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --info-color: #0dcaf0;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --box-shadow-lg: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        /* Global Styles */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
        }

        .page-content {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        /* Header Breadcrumbs */
        .header-breadcrumbs {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow-lg);
        }

        .header-breadcrumbs h1 {
            font-weight: 700;
            margin: 0;
            font-size: 2.5rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: white;
        }

        .breadcrumb-item.active {
            color: white;
            font-weight: 600;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
        }

        /* Property Head Section */
        .property-head {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-lg);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .property-head-btm {
            padding: 2rem;
            align-items: center;
        }

        .pro-head-tit {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .pro-head-tit img {
            border-radius: 50%;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .pro-head-tit img:hover {
            transform: scale(1.05);
        }

        .pro-head-txt {
            font-size: 1.1rem;
            color: var(--secondary-color);
            margin: 0;
        }

        .apply-btn {
            background: linear-gradient(135deg, var(--success-color) 0%, #146c43 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
            border: none;
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow-lg);
            color: white;
        }

        /* Property Content */
        .property-content {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-lg);
            margin-bottom: 2rem;
        }

        .property-img-sec {
            padding: 2rem;
        }

        /* Image Gallery */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--box-shadow-lg);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        #mainImage {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        #mainImage:hover {
            transform: scale(1.02);
        }

        .thumb {
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .thumb:hover {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }

        /* Property Details */
        .pro-detail-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .pro-detail-box:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow);
        }

        .pro-detail-txt-1 {
            color: var(--secondary-color);
            font-weight: 600;
            margin: 0;
        }

        .pro-detail-txt-2 {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Content Sections */
        .content {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-lg);
            margin-bottom: 2rem;
        }

        .wizard-border {
            border: none;
            border-radius: var(--border-radius);
        }

        /* Table Styling */
        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            border: none;
            font-weight: 600;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Button Styling */
        .btn {
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        .btn-outline-dark {
            border-color: var(--dark-color);
            color: var(--dark-color);
        }

        .btn-outline-dark:hover {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
            transform: translateY(-1px);
        }

        /* Location Section */
        .fas.fa-map-marker-alt {
            color: var(--danger-color);
        }

        /* Management Team */
        .rounded-circle {
            border: 4px solid var(--light-color);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .rounded-circle:hover {
            transform: scale(1.05);
            border-color: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .pro-head-tit {
                font-size: 1.8rem;
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .property-head-btm {
                padding: 1.5rem;
                text-align: center;
            }

            .property-img-sec {
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .pro-detail-box {
                padding: 1rem;
            }

            .header-breadcrumbs h1 {
                font-size: 2rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in-left {
            animation: slideInLeft 0.6s ease-out;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0056b3;
        }

        /* Loading Animation */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <!-- Loading Spinner -->
    <div class="loader">
        <div class="spinner"></div>
    </div>

    <!-- Breadcrumb -->
    <div class="page-content">
        @if(Auth::check())
          <div class="header-breadcrumbs fade-in">
              <div class="container-fluid">
                  <div class="row align-items-center">
                      <div class="col-sm-6">
                          <h1><i class="fas fa-building me-3"></i>Property Details</h1>
                      </div>
                      <div class="col-sm-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/dashboard') }}"><i class="fas fa-home me-1"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/propertyList') }}">Properties List</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $property->propertyName }}</li>
                            </ol>
                        </nav>
                      </div>
                  </div>
              </div>
          </div>
        @endif

        <!-- Alerts Section -->
        @if(Auth::check() && Auth::user()->user_type == 1)
            @if($checkWhitelist )
                @if($checkWhitelist->status === 'Cancelled' && $showRejectAlert)
                    <div class="alert alert-danger fade-in" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Issuer Note:</strong> {{ $checkWhitelist->note }}
                    </div>
                @elseif($checkWhitelist->status === 'Pending')
                    <div class="alert alert-info fade-in" role="alert">
                        <i class="fas fa-clock me-2"></i>
                        <strong>Status:</strong> You have sent an approval request. Please wait for the issuer's approval.
                    </div>
                @endif
            @else
                <div class="alert alert-info fade-in" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Important:</strong> If you want to purchase tokens from this asset/property, first you have to send an approval request to the issuer who will review your profile before accepting your purchase request. This approval is needed only on the first purchase; once approved, you can purchase as many times later.
                </div>
            @endif
        @endif

        <div class="content py-4">
            <!-- Start container-fluid -->
            <div class="container-fluid wizard-border">
                <!-- Property Head Starts -->
                <div class="property-head slide-in-left">
                    <div class="container">
                        <div class="property-head-btm row">
                            <div class="col-md-7">
                                <h2 class="pro-head-tit">
                                    <img
                                        id="iconImage"
                                        src="{{ @img($property->propertyLogo) }}"
                                        class="rounded border"
                                        style="object-fit: contain; width: 50px; height: 50px;"
                                        alt="Main Property Image"
                                    >
                                    {{ @$property->propertyName }}
                                    <span class="badge bg-primary ms-2" style="font-size: 0.8rem;">
                                        @if($property->token_type == 1)
                                            Property Token
                                        @elseif($property->token_type == 2)
                                            Asset Token
                                        @elseif($property->token_type == 3)
                                            Utility Token
                                        @endif
                                    </span>
                                </h2>

                                <p class="pro-head-txt">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    {{ @$property->propertyLocation }}
                                </p>
                            </div>

                            <div class="col-md-5 right-col">
                                <div class="apply-btn-wrap text-end">
                                    @if (Auth::check())
                                        @if(Auth::user()->user_type == 1)
                                            @if($property->property_state == 'comingsoon')
                                                <button class="apply-btn" disabled style="background: var(--secondary-color);">
                                                    <i class="fas fa-clock me-2"></i>Coming Soon
                                                </button>
                                            @elseif ($property->userContract->tokenbalance > 0)
                                                <a href="{{ url('applyInvest/'.$property->id) }}" class="apply-btn">
                                                    <i class="fas fa-chart-line me-2"></i>
                                                    @if(@$checkWhitelist->status == 'Pending')
                                                        Waiting for approval
                                                    @elseif(@$checkWhitelist->status == 'Approved')
                                                        Purchase
                                                    @elseif(@$checkWhitelist->status == 'Cancelled')
                                                        Request Rejected
                                                    @else
                                                        Ready to Invest
                                                    @endif
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <a href="/profile" class="apply-btn">
                                            <i class="fas fa-user-plus me-2"></i>Invest
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Property Head Ends -->

                <!-- Property Content Starts -->
                <div class="property-content fade-in">
                    <div class="container-fluid">
                        <!-- Property Image Section Starts -->
                        <div class="property-img-sec row">
                            <!-- Property-img-box Starts -->
                            <div class="col-md-6 left-col">
                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-images me-2"></i>Property Images
                                        </h5>

                                        <!-- Main Image -->
                                        <div class="mb-4">
                                            <img
                                                id="mainImage"
                                                src="{{ @img($property->propertyImages[0]->image) }}"
                                                class="img-fluid img-thumbnail rounded border pro-details-1"
                                                style="object-fit: contain; max-height: 400px;"
                                                alt="Main Property Image"
                                            >
                                        </div>
                                    </div>

                                    @if ($property->propertyImages && count($property->propertyImages) > 0)
                                        <!-- Thumbnails -->
                                        <div class="card-body pt-0">
                                            <h6 class="text-muted mb-3">Gallery</h6>
                                            <div class="d-flex justify-content-start flex-wrap gap-2">
                                                @foreach ($property->propertyImages as $img)
                                                    <img
                                                        src="{{ img($img->image) }}"
                                                        class="img-thumbnail thumb"
                                                        style="width: 80px; height: 60px; object-fit: cover; cursor: pointer;"
                                                        alt="Thumbnail"
                                                        onclick="document.getElementById('mainImage').src = this.src"
                                                    >
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Property Image Right Starts -->
                            <div class="col-md-6 right-col">
                                <div class="property-img-right">
                                    <h5 class="mb-4">
                                        <i class="fas fa-chart-bar me-2"></i>Investment Details
                                    </h5>

                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1">
                                                    <i class="fas fa-percentage me-2"></i>Expected Annual Return
                                                </p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->expectedIrr }}%</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pro-detail-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1">
                                                    <i class="fas fa-calendar-alt me-2"></i>Expected Holding period
                                                </p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->holdingPeriod }} years</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pro-detail-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1">
                                                    <i class="fas fa-dollar-sign me-2"></i>Minimum Investment
                                                </p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">${{ @$property->initialInvestment }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($property->token_type == 2)
                                        <div class="pro-detail-box">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1">
                                                        <i class="fas fa-users me-2"></i>Funded members
                                                    </p>
                                                </div>
                                                <div class="col-lg-8 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->fundedMembers }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="pro-detail-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1">
                                                    <i class="fas fa-coins me-2"></i>Total Tokens
                                                </p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->userContract->tokensupply ?? 0 }} {{$property->userContract->tokensymbol}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pro-detail-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1">
                                                    <i class="fas fa-wallet me-2"></i>Remaining Tokens
                                                </p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->userContract->tokenbalance ?? 0 }} {{$property->userContract->tokensymbol}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pro-detail-box">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1">
                                                    <i class="fas fa-tag me-2"></i>Token Price
                                                </p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">${{ @$property->userContract->tokenvalue }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($property->userContract->contract_address && $property->contract_link)
                                        <div class="pro-detail-box">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1">
                                                        <i class="fas fa-link me-2"></i>Contract Address
                                                    </p>
                                                </div>
                                                <div class="col-lg-8 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">
                                                        <a href="{{ $property->contract_link }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                                            <small>{{ $property->userContract->contract_address }}</small>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($property->yearOfConstruction)
                                        <div class="pro-detail-box">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1">
                                                        <i class="fas fa-building me-2"></i>Year of Build
                                                    </p>
                                                </div>
                                                <div class="col-lg-8 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ $property->yearOfConstruction }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content py-4">
                    <div class="container-fluid wizard-border">
                        <!-- Property Overview -->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-10 mx-auto">
                                    <!-- Overview Section -->
                                    <div class="card shadow-sm mb-4 fade-in">
                                        <div class="card-body">
                                            <h2 class="card-title">
                                                <i class="fas fa-info-circle me-2"></i>Overview
                                            </h2>
                                            <p class="text-muted">{{ @$property->propertyOverview }}</p>
                                        </div>
                                    </div>

                                    @if($property->token_type == 2)
                                        <!-- Highlights Section -->
                                        <div class="card mb-4 shadow-sm fade-in">
                                            <div class="card-body">
                                                <h2 class="card-title">
                                                    <i class="fas fa-star me-2"></i>Highlights
                                                </h2>
                                                <p class="text-muted">{{ @$property->propertyHighlights }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Landmark Table -->
                                    @if(!$property->propertyLandmark->isEmpty())
                                        <div class="card mb-4 shadow-sm fade-in">
                                            <div class="card-body">
                                                <h2 class="card-title">
                                                    <i class="fas fa-map-pin me-2"></i>Landmarks
                                                </h2>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fas fa-landmark me-2"></i>Landmark Name</th>
                                                                <th><i class="fas fa-route me-2"></i>Distance</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($property->propertyLandmark[0]))
                                                                @foreach ($property->propertyLandmark as $landmark)
                                                                    <tr>
                                                                        <td>{{ @$landmark->landmarkName }}</td>
                                                                        <td><span class="badge bg-info">{{ @$landmark->landmarkDist }} km</span></td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="2" class="text-center text-muted">No landmarks available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Connectivity -->
                                    @if(@$property->propertyConnectivityOverview)
                                        <div class="card mb-4 shadow-sm fade-in">
                                            <div class="card-body">
                                                <h2 class="card-title">
                                                    <i class="fas fa-wifi me-2"></i>Connectivity
                                                </h2>
                                                <p class="text-muted">{{ @$property->propertyConnectivityOverview }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Location Section -->
                                    @if (!empty($property->propertyLocation))
                                        <div class="card mb-4 shadow-sm fade-in">
                                            <div class="card-body">
                                                <h2 class="card-title">
                                                    <i class="fas fa-map-marker-alt me-2"></i>Location Details
                                                </h2>
                                                <h5 class="text-primary mb-3">
                                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                                    {{ @$property->propertyLocation }}
                                                </h5>
                                                <p class="text-muted">{{ @$property->propertyLocationOverview }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Brochure -->
                                    @if (!empty($property->brochure))
                                        <div class="card mb-4 shadow-sm fade-in">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <h2 class="mb-0">
                                                    <i class="fas fa-file-pdf me-2"></i>Brochure
                                                </h2>
                                                @if($property->brochure)
                                                    <a href="{{ @img($property->brochure) }}" target="_blank" class="btn btn-outline-primary">
                                                        <i class="far fa-file-pdf me-2"></i>View Brochure
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Property Details -->
                                    @if($property->token_type == 1)
                                        <div class="card mb-4 shadow-sm fade-in">
                                            <div class="card-body row">
                                                <div class="col-md-6">
                                                    <h2 class="card-title">
                                                        <i class="fas fa-home me-2"></i>Property Details
                                                    </h2>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                @if($property->token_type == 2)
                                                                    <tr><td><i class="fas fa-chart-pie me-2"></i>Total Deal Size</td><td>{{ @$property->totalDealSize }}</td></tr>
                                                                    <tr><td><i class="fas fa-percentage me-2"></i>Expected Annual Return (%)</td><td>{{ @$property->expectedIrr }}</td></tr>
                                                                    <tr><td><i class="fas fa-users me-2"></i>Funded Members</td><td>{{ @$property->fundedMembers }}</td></tr>
                                                                    <tr><td><i class="fas fa-dollar-sign me-2"></i>Minimum Investment</td><td>{{ @$property->initialInvestment }}</td></tr>
                                                                    <tr><td><i class="fas fa-calendar-alt me-2"></i>Minimum Holding Period</td><td>{{ @$property->holdingPeriod }}</td></tr>
                                                                @else
                                                                    <tr><td><i class="fas fa-map-marker-alt me-2"></i>Location</td><td>{{ @$property->locality }}</td></tr>
                                                                    <tr><td><i class="fas fa-building me-2"></i>Year of Build</td><td>{{ @$property->yearOfConstruction }}</td></tr>
                                                                    <tr><td><i class="fas fa-layer-group me-2"></i>Community</td><td>{{ @$property->storeys }}</td></tr>
                                                                    <tr><td><i class="fas fa-bed me-2"></i>Bedrooms</td><td>{{ @$property->propertyParking }}</td></tr>
                                                                    <tr><td><i class="fas fa-bath me-2"></i>Bathrooms</td><td>{{ @$property->floorforSale }}</td></tr>
                                                                    @if(@$property->propertyTotalBuildingArea)
                                                                        <tr><td><i class="fas fa-ruler-combined me-2"></i>Total Area</td><td>{{ @$property->propertyTotalBuildingArea }} sft</td></tr>
                                                                    @endif
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                                                    @if($property->token_type == 1 && $property->floorplan)
                                                        <h5 class="mb-3">
                                                            <i class="fas fa-drafting-compass me-2"></i>Floor Plan
                                                        </h5>
                                                        <a href="{{ @img($property->floorplan) }}" target="_blank" class="btn btn-outline-secondary">
                                                            <i class="far fa-file-pdf me-2"></i>View Floor Plan
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Documents Section -->
                                    <div class="card mb-4 shadow-sm fade-in">
                                        <div class="card-body">
                                            @php
                                                $documents = [
                                                    'Prospectus' => $property->investor,
                                                    'Report' => $property->titlereport,
                                                    'Agreements' => $property->termsheet,
                                                    'Share Certificate' => $property->propertyUpdatesDoc,
                                                ];
                                            @endphp

                                            @if (collect($documents)->filter()->isNotEmpty())
                                                <h2 class="card-title">
                                                    <i class="fas fa-file-alt me-2"></i>Documents
                                                </h2>
                                                <div class="row text-center">
                                                    @foreach ($documents as $label => $doc)
                                                        @if ($doc)
                                                            <div class="col-md-3 mb-4">
                                                                <div class="card h-100 border-0 shadow-sm">
                                                                    <div class="card-body">
                                                                        <i class="far fa-file-pdf fa-3x text-danger mb-3"></i>
                                                                        <h6 class="card-title">{{ $label }}</h6>
                                                                        <a href="{{ @img($doc) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                                                            <i class="far fa-eye me-1"></i>View
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if($property->ManagementTeamDescription)
                                        <!-- Management Team Section -->
                                        <div class="card shadow-sm fade-in">
                                            <div class="card-body">
                                                <h2 class="card-title">
                                                    <i class="fas fa-users-cog me-2"></i>Management Team
                                                </h2>
                                                <p class="text-muted mb-4">{{ @$property->ManagementTeamDescription }}</p>
                                                <div class="row">
                                                    @foreach(@$property->members as $member)
                                                        <div class="col-md-4 text-center mb-4">
                                                            <div class="card border-0 shadow-sm h-100">
                                                                <div class="card-body">
                                                                    <img src="{{ img(@$member->memberPic) }}" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                                                                    <h5 class="card-title mb-1">{{ @$member->memberName }}</h5>
                                                                    <p class="text-primary fw-bold mb-2">{{ @$member->memberPosition }}</p>
                                                                    <p class="small text-muted">Short bio...<br><span class="text-muted">Full details about the team member here...</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Loading animation
        $(window).on('load', function () {
            $(".loader").fadeOut(1000);
            $(".fade-in").each(function(index) {
                $(this).delay(200 * index).fadeIn(800);
            });
        });

        // Thumbnail click handler
        document.querySelectorAll('.thumb').forEach(function(thumb) {
            thumb.addEventListener('click', function () {
                const mainImg = document.getElementById('mainImage');
                mainImg.src = this.src;

                // Add a subtle animation
                mainImg.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    mainImg.style.transform = 'scale(1)';
                }, 200);
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effects to cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Progress bar animation
        function animateProgressBars() {
            document.querySelectorAll('.progress-bar').forEach(bar => {
                const width = bar.getAttribute('aria-valuenow');
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width + '%';
                }, 500);
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });
    </script>
@endsection
