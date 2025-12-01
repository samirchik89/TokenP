@extends('issuer.layout.base')
@section('content')
@section('style')
<style>
    .my_highlights ul li {
        margin-bottom: 10px;
        color: #929292;
        font-size: 14px;
        line-height: 1.6;
        letter-spacing: .2px;
    }
    dl, ol, ul {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .nav-pills > li > a, .nav-tabs > li > a {
        padding: 15px;
    }
    .product-slider {
        padding: 25px;
    }
    .product-slider #carousel {
        /* border: 4px solid #1089c0; */
        margin: 0;
    }
    .product-slider #thumbcarousel {
        margin: 12px 0 0;
        padding: 0 10px;
    }
    .product-slider #thumbcarousel .item {
        text-align: center;
    }
    .product-slider #thumbcarousel .item .thumb {
        width: 15%;
        margin: 0 2%;
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        max-width: 98px;
    }
    .product-slider #thumbcarousel .item .thumb:hover {
        border-color: #1089c0;
    }
    .product-slider .item img {
        width: 100%;
        height: 75px;
        object-fit: cover;
        border-radius: 5px !important;
    }
    .carousel-control {
        color: #0284b8;
        text-align: center;
        text-shadow: none;
        font-size: 30px;
        width: 30px;
        height: 30px;
        line-height: 20px;
        top: 23%;
    }
    .carousel-control:hover,
    .carousel-control:focus,
    .carousel-control:active {
        color: #333;
    }
    .carousel-caption,
    .carousel-control .fa {
        /*font: normal normal normal 30px/26px FontAwesome;*/
    }
    .carousel-control {
        background-color: rgba(0, 0, 0, 0);
        bottom: auto;
        font-size: 20px;
        left: 0;
        position: absolute;
        top: 30%;
        width: auto;
    }
    .carousel-control.right,
    .carousel-control.left {
        background-color: rgba(0, 0, 0, 0);
        background-image: none;
    }
    /* .showing {
        border: 2px solid #4a28f5;
    } */
    .product-slider .carousel-inner {
        border-radius: 5% !important;
        box-shadow: 0px 0px 15px 1px rgb(33 33 33 / 30%);
        object-fit: cover;
    }
    div#thumbcarousel .carousel-inner {
        box-shadow: none !important;
    }
    div#carousel .carousel-inner .item img {
        height: 400px !important;
        width: 100%;
    }
    .fa-angle-right:before {
        content: "\f105";
        top: 0;
        bottom: 0;
        right: 0;
        left: -15px;
        position: relative;
    }
    .fa-angle-left:before {
        content: "\f104";
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        position: relative;
    }
    .product-slider {
        padding: 25px;
    }
    .product-slider #carouselSecond {
        /* border: 4px solid #1089c0; */
        margin: 0;
    }
    .product-slider #thumbcarouselSecond {
        margin: 12px 0 0;
        padding: 0 10px;
    }
    .product-slider #thumbcarouselSecond .item {
        text-align: center;
    }
    .product-slider #thumbcarouselSecond .item .thumb {
        width: 15%;
        margin: 0 2%;
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        max-width: 98px;
    }
    .product-slider #thumbcarouselSecond .item .thumb:hover {
        border-color: #1089c0;
    }
    .product-slider .item img {
        width: 100%;
        height: 75px;
        object-fit: cover;
        border-radius: 5px !important;
    }
    .carousel-control {
        color: #0284b8;
        text-align: center;
        text-shadow: none;
        font-size: 30px;
        width: 30px;
        height: 30px;
        line-height: 20px;
        top: 23%;
    }
    .carousel-control:hover,
    .carousel-control:focus,
    .carousel-control:active {
        color: #333;
    }
    .carousel-caption,
    .carousel-control .fa {
        /*font: normal normal normal 30px/26px FontAwesome;*/
    }
    .carousel-control {
        background-color: rgba(0, 0, 0, 0);
        bottom: auto;
        font-size: 20px;
        left: 0;
        position: absolute;
        top: 30%;
        width: auto;
    }
    .carousel-control.right,
    .carousel-control.left {
        background-color: rgba(0, 0, 0, 0);
        background-image: none;
    }
    /* .showing {
        border: 2px solid #4a28f5;
    } */
    .product-slider .carousel-inner {
        border-radius: 5% !important;
        box-shadow: 0px 0px 15px 1px rgb(33 33 33 / 30%);
        object-fit: cover;
    }
    div#thumbcarouselSecond .carousel-inner {
        box-shadow: none !important;
    }
    div#carouselSecond .carousel-inner .item img {
        height: 400px !important;
        width: 100%;
    }
    .fa-angle-right:before {
        content: "\f105";
        top: 0;
        bottom: 0;
        right: 0;
        left: -15px;
        position: relative;
    }
    .fa-angle-left:before {
        content: "\f104";
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        position: relative;
    }
    @media (max-width: 767px) {
        .product-slider #thumbcarousel .item .thumb, .product-slider #thumbcarouselSecond .item .thumb {
            max-width: 30px !important;
        }
        .product-slider .item img {
            height: 50px !important;
        }
    }
    /* Third Carasol Start */
    .product-slider #carouselThird {
        /* border: 4px solid #1089c0; */
        margin: 0;
    }
    .product-slider #thumbcarouselThird {
        margin: 12px 0 0;
        padding: 0 10px;
    }
    .product-slider #thumbcarouselThird .item {
        text-align: center;
    }
    .product-slider #thumbcarouselThird .item .thumb {
        width: 15%;
        margin: 0 2%;
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        max-width: 98px;
    }
    .product-slider #thumbcarouselThird .item .thumb:hover {
        border-color: #1089c0;
    }
    div#thumbcarouselThird .carousel-inner {
        box-shadow: none !important;
    }
    div#carouselThird .carousel-inner .item img {
        height: 400px !important;
        width: 100%;
    }
    @media (max-width: 767px) {
        .product-slider #thumbcarouselThird .item .thumb {
            max-width: 30px !important;
        }
    }
    /* Third Carasol End */
    .carousel-indicators {
        right: 50%;
        top: auto;
        bottom: -10px;
        margin-right: -19px;
    }
    .team_slide {
        padding: 0 40px 30px 40px;
    }
    .carousel-indicators li {
        background: #cecece;
    }
    .carousel-indicators .active {
        background: #428bca;
    }
    a.left.carousel-control, a.right.carousel-control {
        font: normal normal normal 30px/26px FontAwesome;
    }

        .provider-details {padding-bottom: 20px;border-bottom: 1px dashed grey;}
        .property-img-sec {padding: 20px 0px 0px;}
        .target-txt {font-size: 23px;font-weight: 700;color: #000102;}
        .pro-progress-block {height: 10px;background-color: #e3e9e9;margin: 20px 0px 15px;border-radius: 30px;position: relative;}
        .progress-txt b {color: #6aa1ff;margin-right: 15px;}
        .pro-detail-box {border-bottom: 1px dashed grey;}
        .progress-txt {display: inline-block;color: #333;padding: 10px 0px;margin-top: -10px !important;font-weight: 800;}
        .pro-detail-txt {margin: 0px;padding: 10px 0px;font-size: 13px;}
        /* ul.nav.nav-tabs.property-nav-tabs li {padding: 25px 50px !important;} */
        .property-content {padding: 40px 0px;}
        .pro-tab-wrap {border-bottom: 1px solid #cecece;background: #fafafa;}
        .nav-tabs > li > a.active {border: 1px dashed #000;border-bottom: 3px solid #000;background: #ffffff;box-shadow: none;padding: 25px 50px !important;}
        .team-member-image img:hover {filter: grayscale(100%);}
        .team-member-image img {width: 100px;height: 100px;border-radius: 50%;}
        .team_member {text-align: center;}
        .p40 {padding: 40px 0px;}
        .tab-content {padding: 0px 0 0 0;}
        .nav-tabs {border-bottom: 1px dashed grey;}
        video.banner_video {
            width: 100%;
            height: 400px;
        }
        video.banner_video .vid {
            height: auto;
        }
    </style>
    <link rel="stylesheet" href="{{asset('asset/package/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/package/css/owl.theme.default.css')}}">
    @endsection
    <div class="content-page-inner"><!-- START content-page -->

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h1>Property Details</h1></div>
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
                                        <span>Property Details</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->


        <!-- Breadcrumb -->
        <div class="page-content">
            <div class="content"><!-- Start cont inner page -->
                <div class="container-fluid wizard-border">
                    <div class="property-content">
                        <div class="container-fluid">
                            <!-- Provider Details Starts -->
                            <div class="provider-details">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h2 class="pro-head-tit">
                                            {{ @$property->propertyName }}
                                            <span class="text-muted" style="font-weight: normal;">
                                                @if($property->token_type == 1)
                                                    (Property Token)
                                                @elseif($property->token_type == 2)
                                                    (Asset Token)
                                                @elseif($property->token_type == 3)
                                                    (Utility Token)
                                                @endif
                                            </span>
                                        </h2>

                                        <p class="pro-head-txt text-secondary">
                                            {{ @$property->propertyLocation }}
                                        </p>
                                    </div>
                                    <div class="col-md-4 right-col">
                                        <div class="apply-btn-wrap text-right">
                                            <a href="{{ route('property') }}" class="apply-btn btn btn-info">Back to Properties</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Provider Details Ends -->
                            <!-- Property Image Section Starts -->
                            <div class="property-img-sec row">
                                <!-- Property-img-box Starts -->
                                <div class="col-md-6 left-col">
                                    <div class="property-img-box">
                                        <img src="{{ @img($property->propertyLogo) }}" width="100%">
                                    </div>
                                </div>
                                <!-- Property-img-box Ends -->
                                <!-- Property Image Right Starts -->
                                <div class="col-md-6 right-col">
                                    <div class="property-img-right">
                                        {{-- <div>
                                            <h5 class="target-txt">Targets</h5>

                                            <div class="property-progress">
                                                <div class="pro-progress-block">
                                                    <div class="progress-value" @if ($property->accuired_percentage < 100)
                                                        style="width: {{ @$property->accuired_percentage }}%;" @else style="width: 100%;"
                                                    @endif>
                                                    </div>
                                                </div>
                                                <span class="progress-txt"><b>{{ price_format(@$property->accuired_percentage, 8) }}% FUNDED</b> ${{ @$property->accuired_usd }} OF ${{ @$property->totalDealSize }}</span>
                                            </div>
                                        </div> --}}
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Token Network</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->issuerToken->coin }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Token Name</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->issuerToken->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property Detail Box Starts -->
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Expected Annual Return</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->expectedIrr }}%</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        {{-- <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Equity Multiple</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->propertyEquityMultiple }}x</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Expected Holding period</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->holdingPeriod }} years</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Minimum Investment</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">${{ @$property->initialInvestment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        @if($property->token_type == 2)
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Funded members</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->fundedMembers  }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Total Deal size</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">${{ @$property->totalDealSize  }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @if(!empty($property->coin) && !empty($property->userContract->contract_address))
                                            <div class="pro-detail-box">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="pro-detail-txt pro-detail-txt-1"><b>Contract Address</b></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="pro-detail-txt pro-detail-txt-2" style="pointer-events: all">
                                                            <a href="{{ $property->contract_link ?? '#' }}" target="_blank">
                                                                {{ ($property->contract_address) }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        {{-- <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Total Sft</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->total_sft }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Property Detail Box Ends -->
                                        <!-- Property Detail Box Starts -->
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Asset Type</b></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->propertyType }}</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <!-- Property Detail Box Ends -->
                                    </div>
                                </div>
                                <!-- Property Image Right Ends -->
                            </div>
                            <!-- Property Image Section Ends -->
                        </div>
                    </div>
                    <!-- Property Content Ends -->
                    <!-- Property Tab Starts -->

                    <div class="content py-4">
                        <div class="container-fluid wizard-border">

                            <!-- Property Overview -->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-10 mx-auto">
                                        <!-- Overview Section -->
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h2 class="card-title">Overview</h2>
                                                <p class="text-muted">{{ @$property->propertyOverview }}</p>
                                            </div>
                                        </div>

                                        @if($property->token_type == 2)
                                            <!-- Highlights Section -->
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-body">
                                                    <h2 class="card-title">Highlights</h2>
                                                    <p class="text-muted">{{ @$property->propertyHighlights }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($property->propertyImages && count($property->propertyImages) > 0)
                                        <div class="card mb-4 shadow-sm border-0">
                                            <div class="card-body ">
                                                <h2 class="card-title">Property Images</h2>

                                                    <!-- Main Image -->
                                                    <div class="mb-4">
                                                        <img
                                                            id="mainImage"
                                                            src="{{ img($property->propertyImages[0]->image) }}"
                                                            class="img-fluid rounded border"
                                                            style="max-height: 550px; object-fit: contain;"
                                                            alt="Main Property Image"
                                                        >
                                                    </div>

                                                    <!-- Thumbnails -->
                                                    <div class="d-flex justify-content-center flex-wrap gap-3">
                                                        @foreach ($property->propertyImages as $img)
                                                            <img
                                                                src="{{ img($img->image) }}"
                                                                class="img-thumbnail thumb"
                                                                style="width: 110px; height: 85px; object-fit: cover; cursor: pointer;"
                                                                alt="Thumbnail"
                                                                onclick="document.getElementById('mainImage').src = this.src"
                                                            >
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif



                                        <!-- Landmark Table -->
                                        @if(!empty($property->propertyLandmark))
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-body">
                                                    <h2 class="card-title">Landmarks</h2>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Landmark Name</th>
                                                                <th>Distance</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($property->propertyLandmark as $landmark)
                                                                <tr>
                                                                    <td>{{ @$landmark->landmarkName }}</td>
                                                                    <td>{{ @$landmark->landmarkDist }} km</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Connectivity -->
                                        @if(@$property->propertyConnectivityOverview)
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-body">
                                                    <h2 class="card-title">Connectivity</h2>
                                                    <p class="text-muted">{{ @$property->propertyConnectivityOverview }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Comparables -->
                                        @if (!empty($property->propertyComparable))
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-body">
                                                    <h2 class="card-title">Comparables</h2>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Property Address</th>
                                                                    <th>Location</th>
                                                                    <th>Sale Date</th>
                                                                    <th>Year of Build</th>
                                                                    <th>Total Sft</th>
                                                                    <th>Sale Price</th>
                                                                    <th>Property Logo</th>
                                                                    <th>Map</th>
                                                                    <th>Comparable Details</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($property->propertyComparable as $value)
                                                                    <tr>
                                                                        <td>{{ @$value->property }}</td>
                                                                        <td>{{ @$value->location }}</td>
                                                                        <td>{{ @$value->type }}</td>
                                                                        <td>{{ @$value->distance }}</td>
                                                                        <td>{{ @$value->rent }}</td>
                                                                        <td>{{ @$value->saleprice }}</td>
                                                                        <td>
                                                                            <img src="{{ @img($property->propertyLogo) }}" width="100">
                                                                        </td>
                                                                        <td>
                                                                            @if(@$value->map)
                                                                                <a href="{{ asset('storage/' . @$value->map) }}" target="_blank">View</a>
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(@$value->comparable_details)
                                                                                <a href="{{ asset('storage/' . @$value->comparable_details) }}" target="_blank">View</a>
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- Location Section -->
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h2 class="card-title"> Location Details</h2>
                                                <h5><i class="fas fa-map-marker-alt text-danger"></i> {{ @$property->propertyLocation }}</h5>
                                                <p class="text-muted">{{ @$property->propertyLocationOverview }}</p>
                                            </div>
                                        </div>

                                        <!-- Brochure -->
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <h2 class="mb-0"> Brochure</h2>
                                                @if($property->brochure)
                                                    <a href="{{ @img($property->brochure) }}" target="_blank" class="btn btn-outline-primary">
                                                        <i class="far fa-file-pdf me-2"></i>View Brochure
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Property Details -->
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body row">
                                                <div class="col-md-6">
                                                    <h2>Property Details</h2>
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            @if($property->token_type == 2)
                                                                <tr><td>Total Deal Size</td><td>{{ @$property->totalDealSize }}</td></tr>
                                                                <tr><td>Expected Annual Return (%)</td><td>{{ @$property->expectedIrr }}</td></tr>
                                                                <tr><td>Funded Members</td><td>{{ @$property->fundedMembers }}</td></tr>
                                                                <tr><td>Minimum Investment</td><td>{{ @$property->initialInvestment }}</td></tr>
                                                                <tr><td>Minimum Holding Period</td><td>{{ @$property->holdingPeriod }}</td></tr>
                                                            @else
                                                                <tr><td>Location</td><td>{{ @$property->locality }}</td></tr>
                                                                <tr><td>Year of Build</td><td>{{ @$property->yearOfConstruction }}</td></tr>
                                                                <tr><td>Community</td><td>{{ @$property->storeys }}</td></tr>
                                                                <tr><td>Bedrooms</td><td>{{ @$property->propertyParking }}</td></tr>
                                                                <tr><td>Bathrooms</td><td>{{ @$property->floorforSale }}</td></tr>
                                                                <tr><td>Total Area</td><td>{{ @$property->propertyTotalBuildingArea }} sft</td></tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                                                    @if($property->token_type == 1 && $property->floorplan)
                                                        <h5>📐 Floor Plan</h5>
                                                        <a href="{{ @img($property->floorplan) }}" target="_blank" class="btn btn-outline-secondary">
                                                            <i class="far fa-file-pdf me-2"></i>View Floor Plan
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Documents Section -->
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h2>Documents</h2>
                                                <div class="row text-center">
                                                    @foreach([
                                                        'Prospectus' => $property->investor,
                                                        'Report' => $property->titlereport,
                                                        'Agreements' => $property->termsheet,
                                                        'Share Certificate' => $property->propertyUpdatesDoc
                                                    ] as $label => $doc)
                                                        @if($doc)
                                                            <div class="col-md-3 mb-4">
                                                                <h5>{{ $label }}</h5>
                                                                <a href="{{ @img($doc) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                                                    <i class="far fa-file-pdf fa-lg me-1"></i>View
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Management Team Section -->
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h2> Management Team</h2>
                                                <p class="text-muted">{{ @$property->ManagementTeamDescription }}</p>
                                                <div class="row">
                                                    @foreach(@$property->members as $member)
                                                        <div class="col-md-4 text-center mb-4">
                                                            <img src="{{ img(@$member->memberPic) }}" class="img-fluid rounded-circle mb-2" style="width: 130px; height: 130px; object-fit: cover;">
                                                            <h5 class="mb-0">{{ @$member->memberName }}</h5>
                                                            <p class="text-muted">{{ @$member->memberPosition }}</p>
                                                            <p class="small">Short bio...<br><span class="text-muted">Full details about the team member here...</span></p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
            <!-- Property Tab Ends -->
    </div>
</div><!-- End cont inner page -->

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
    </div> <!-- End content-page -->

@endsection


@section('scripts')
    <!-- Owl -->
    <script src="https://direxct.com/asset/package/js/wizard/wizard.js"></script>
    <script src="/asset/package/js/owl.carousel.js"></script>
    <script>
        //$(".pro-slider-wrap").hide();
        $(window).load(function () {
            $(".loader").delay(2000).fadeOut(2000);
            $(".pro-slider-wrap").delay(2500).fadeIn(2500);
            //$(".pro-slider-wrap").delay(2000).show();

        });


        $(function () {
            $("#map").googleMap({
                                    zoom  : 15, // Initial zoom level (optional)
                                    coords: [17.438136, 78.395246], // Map center (optional)
                                    type  : "ROADMAP" // Map type (optional)
                                });
        })

    </script>

    <script>
        $('#carousel').on('slid.bs.carousel', function (e) {
            var active = $(this).find('.active').index();
            var to     = $(e.relatedTarget).index();

            $('#thumbcarousel').find('.showing').removeClass('showing');
            $('#thumbcarousel').find('[data-slide-to=' + active + ']').addClass('showing');

        });

        $('#carousel').on('slide.bs.carousel', function (e) {
            var active = $(this).find('.active').index();
            var to     = $(e.relatedTarget).index();

            if (active == 4 && to == 5) {
                $('#thumbcarousel').carousel('next');
            }
            if (active == 9 && to == 0) {
                $('#thumbcarousel').carousel('next');
            }
        });


        $('#carouselSecond').on('slid.bs.carousel', function (e) {
            var active = $(this).find('.active').index();
            var to     = $(e.relatedTarget).index();

            $('#thumbcarouselSecond').find('.showing').removeClass('showing');
            $('#thumbcarouselSecond').find('[data-slide-to=' + active + ']').addClass('showing');

        });

        $('#carouselSecond').on('slide.bs.carousel', function (e) {
            var active = $(this).find('.active').index();
            var to     = $(e.relatedTarget).index();

            if (active == 4 && to == 5) {
                $('#thumbcarouselSecond').carousel('next');
            }
            if (active == 9 && to == 0) {
                $('#thumbcarouselSecond').carousel('next');
            }
        });

        $('#carouselThird').on('slid.bs.carousel', function (e) {
            var active = $(this).find('.active').index();
            var to     = $(e.relatedTarget).index();

            $('#thumbcarouselThird').find('.showing').removeClass('showing');
            $('#thumbcarouselThird').find('[data-slide-to=' + active + ']').addClass('showing');

        });

        $('#carouselThird').on('slide.bs.carousel', function (e) {
            var active = $(this).find('.active').index();
            var to     = $(e.relatedTarget).index();

            if (active == 4 && to == 5) {
                $('#thumbcarouselThird').carousel('next');
            }
            if (active == 9 && to == 0) {
                $('#thumbcarouselThird').carousel('next');
            }
        });


    </script>
@endsection
