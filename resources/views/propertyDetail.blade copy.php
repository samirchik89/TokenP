@extends($layout)

@section('content')
    <style>

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
        /* .container {
            width: 100%;
            max-width: 100%;
        } */
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
        video.banner_video {
            width: 100%;
            height: 400px;
        }
        video.banner_video .vid {
            height: auto;
        }

        .card, .card-body, .card-title, .pro-detail-box, .img-thumbnail, .pro-details-1 {
            border: none !important;
            box-shadow: none !important;
        }

        .thumb {
            border: none !important;
        }

        .property-head, .property-content {
            border: none !important;
        }
    </style>
    <!-- Breadcrumb -->
    <div class="page-content">
        @if(Auth::check())
          <div class="header-breadcrumbs">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-sm-6"><h1>Property Details</h1></div>
                      <div class="col-sm-6">
                        @include('issuer.layout.breadcrumb',['items'=>[
                            ['title'=>'Home','url'=>url('/dashboard')],
                            ['title'=>'Properties List','url'=>url('/propertyList')],
                            ['title'=>$property->propertyName],
                        ]])
                      </div>
                  </div>
              </div>
          </div>
        @endif
      <!-- End Breadcrumb -->

      <!-- End Breadcrumb -->
      @if(Auth::check() && Auth::user()->user_type == 1)
            @if($checkWhitelist )
                @if($checkWhitelist->status === 'Cancelled' && $showRejectAlert)
                    <div class="alert alert-danger" role="alert" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;">
                        Issuer Note: {{ $checkWhitelist->note }}
                    </div>
                @elseif($checkWhitelist->status === 'Pending')
                    <div class="alert alert-info" role="alert" style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb;">
                        You have sent an approval request. Please wait for the issuer’s approval.
                    </div>
                @endif
            @else
                <div class="alert alert-info" role="alert" style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb;">
                    If you want to purchase tokens from this asset/property, first you have to send an approval request to the issuer who will review your profile before accepting your purchase request. This approval is needed only on the first purchase; once approved, you can purchase as many times later.
                </div>
            @endif
        @endif





        <div class="content py-4">
            <!-- Start container-fluid -->
            <div class="container-fluid wizard-border">
                <!-- Property Head Starts -->
                <div class="property-head">
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
                                    <span class="text-muted" style="font-weight: normal; font-size:20px">
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

                            <div class="col-md-5 right-col">
                                <div class="apply-btn-wrap text-right"> <!-- {{ url('applyInvest/'.$property->id) }} -->
                                    @if (Auth::check()  )
                                        @if(Auth::user()->user_type == 1)
                                            @if($property->property_state == 'comingsoon')
                                                <a class="apply-btn" style="cursor:default">
                                                    Coming Soon
                                                </a>
                                            @elseif ($property->userContract->tokenbalance > 0)
                                                <a href="{{ url('applyInvest/'.$property->id) }}" class="apply-btn">
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
                                            Invest
                                        </a>
                                    @endif
                                        </br>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Property Head Ends -->
                <!-- Property Content Starts -->
                <div class="property-content">
                    <div class="container-fluid">

                        <!-- Property Image Section Starts -->
                        <div class="property-img-sec row">
                            <!-- Property-img-box Starts -->
                            <div class="col-md-6 left-col">

                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body ">
                                        {{-- <h2 class="card-title">Property Images</h2> --}}

                                        <!-- Main Image -->
                                        <div class="mb-4">
                                            <img
                                                id="mainImage"
                                                src="{{ @img($property->propertyImages[0]->image) }}"
                                                class="img-fluid img-thumbnail rounded border pro-details-1"
                                                style="object-fit: contain;"
                                                alt="Main Property Image"
                                            >
                                        </div>
                                    </div>

                                    @if ($property->propertyImages && count($property->propertyImages) > 0)
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
                                    @endif
                                </div>
                                <!-- Slider End -->


                            </div>
                            <!-- Property Image Right Starts -->
                            <div class="col-md-6 right-col">
                                <div class="property-img-right">

                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Expected Annual Return</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->expectedIrr }}%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Property Detail Box Ends -->

                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Expected Holding period</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->holdingPeriod }} years</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Property Detail Box Ends -->
                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Minimum Investment</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">${{ @$property->initialInvestment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Property Detail Box Ends -->
                                    <!-- Property Detail Box Starts -->
                                    @if($property->token_type == 2)
                                        <div class="pro-detail-box">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-1"><b>Funded members</b></p>
                                                </div>
                                                <div class="col-lg-8 col-md-6">
                                                    <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->fundedMembers }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Property Detail Box Ends -->
                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Total Tokens</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->userContract->tokensupply ?? 0 }} {{$property->userContract->tokensymbol}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-detail-box">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Remaining Tokens</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->userContract->tokenbalance ?? 0 }} {{$property->userContract->tokensymbol}}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="pro-detail-box">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Token Price</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">${{ @$property->userContract->tokenvalue  }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($property->userContract->contract_address && $property->contract_link)
                                        <div class="row pro-det-list">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="pro-det-txt1 pro-det-txt"><b>Contract Address:</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <p class="pro-det-txt2 pro-det-txt">
                                                    <a href="{{ $property->contract_link }}" target="_blank" rel="noopener noreferrer">
                                                        {{ $property->userContract->contract_address }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if( $property->yearOfConstruction)
                                        <div class="row pro-det-list">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <p class="pro-det-txt1 pro-det-txt"><b>Year of Build</b></p>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <p class="pro-det-txt2 pro-det-txt">
                                                    {{ $property->yearOfConstruction}}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Total sft</b></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->total_sft }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Property Detail Box Ends -->
                                    <!-- Property Detail Box Starts -->
                                    <div class="pro-detail-box" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-1"><b>Asset Type</b></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->propertyType }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Property Detail Box Ends -->
                                </div>
                                <hr>

                            </div>
                            <!-- Property Image Right Ends -->
                        </div>
                        <!-- Property Image Section Ends -->
                    </div>
                </div>

                <div class="content py-4">
                    <div class="container-fluid wizard-border">

                        <!-- Property Overview -->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-10 mx-auto">
                                    <!-- Overview Section -->
                                     <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h2> Overview</h2>
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

                                    {{-- @if ($property->propertyImages && count($property->propertyImages) > 0)
                                    <div class="card mb-4 shadow-sm border-0">
                                        <div class="card-body ">
                                            <h2 class="card-title">Property Images</h2>

                                                <!-- Main Image -->
                                                <div class="mb-4">
                                                    <img
                                                        id="mainImage"
                                                        src="{{ img($property->propertyImages[0]->image) }}"
                                                        class="img-fluid rounded border pro-details-1"
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
                                    @endif --}}



                                    <!-- Landmark Table -->
                                    @if(!$property->propertyLandmark->isEmpty())
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h2 class="card-title">Landmarks</h2>
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Landmark Name</th>
                                                            <th>Distance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($property->propertyLandmark[0]))
                                                            @foreach ($property->propertyLandmark as $landmark)
                                                                <tr>
                                                                    <td>{{ @$landmark->landmarkName }}</td>
                                                                    <td>{{ @$landmark->landmarkDist }} km</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td>-</td>
                                                                <td>-</td>
                                                            </tr>
                                                        @endif
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
                                    {{-- @if (!($property->propertyComparable->isEmpty()))
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h2 class="card-title">Comparables</h2>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Property Address</th>
                                                                <th>Sale Date</th>
                                                                <th>Year of Build</th>
                                                                <th>Total Sft</th>
                                                                <th>Sale Price</th>
                                                                <th>Map</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($property->propertyComparable as $value)
                                                                <tr>
                                                                    <td>{{ @$value->property }}</td>
                                                                    <td>{{ @$value->type }}</td>
                                                                    <td>{{ @$value->distance }}</td>
                                                                    <td>{{ @$value->rent }}</td>
                                                                    <td>{{ @$value->saleprice }}</td>

                                                                    <td>
                                                                        @if(@$value->map)
                                                                            <a href="{{ asset('storage/' . @$value->map) }}" target="_blank">View</a>
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
                                    @endif --}}
                                    <!-- Location Section -->

                                    @if (!empty($property->propertyLocation))
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body">
                                                <h2 class="card-title"> Location Details</h2>
                                                <h5><i class="fas fa-map-marker-alt text-danger"></i> {{ @$property->propertyLocation }}</h5>
                                                <p class="text-muted">{{ @$property->propertyLocationOverview }}</p>
                                            </div>
                                        </div>
                                    @endif


                                    <!-- Brochure -->
                                    @if (!empty($property->brochure))
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
                                    @endif

                                    <!-- Property Details -->
                                    @if($property->token_type == 1)
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
                                                                <tr><td>Minimum Holding Period</td><td>{{ @$property->holdingPeriod }}</td></tr>

                                                            @else
                                                                <tr><td>Location</td><td>{{ @$property->locality }}</td></tr>
                                                                <tr><td>Year of Build</td><td>{{ @$property->yearOfConstruction }}</td></tr>
                                                                <tr><td>Community</td><td>{{ @$property->storeys }}</td></tr>
                                                                <tr><td>Bedrooms</td><td>{{ @$property->propertyParking }}</td></tr>
                                                                <tr><td>Bathrooms</td><td>{{ @$property->floorforSale }}</td></tr>
                                                                @if(@$property->propertyTotalBuildingArea)
                                                                <tr><td>Total Area</td><td>{{ @$property->propertyTotalBuildingArea  }} sft</td></tr>
                                                                @endif
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
                                    @endif

                                    <!-- Documents Section -->
                                    <div class="card mb-4 shadow-sm">
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
                                                <h2>Documents</h2>
                                                <div class="row text-center">
                                                    @foreach ($documents as $label => $doc)
                                                        @if ($doc)
                                                            <div class="col-md-3 mb-4">
                                                                <h5>{{ $label }}</h5>
                                                                <a href="{{ @img($doc) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                                                    <i class="far fa-file-pdf fa-lg me-1"></i>View
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if($property->ManagementTeamDescription)
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
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        {{-- </div> --}}
    </div>
    </div>
    <!-- Property Tab Ends -->
@endsection


@section('scripts')

    <script>
        //$(".pro-slider-wrap").hide();
        $(window).load(function () {
            $(".loader").delay(2000).fadeOut(2000);
            $(".pro-slider-wrap").delay(2500).fadeIn(2500);
            //$(".pro-slider-wrap").delay(2000).show();

        });

        // Hightchart JS
        // Highcharts.chart('container', {
        //     chart: {
        //         type: 'bar'
        //     },
        //     xAxis: {
        //         categories: ['Equity']
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: 'Equity'
        //         }
        //     },
        //     colors: [
        //         '#4a69bd',
        //         '#1e3799',
        //         '#0c2461'
        //     ],
        //     legend: {
        //         reversed: true
        //     },
        //     plotOptions: {
        //         series: {
        //             stacking: 'normal'
        //         },
        //         column: {
        //             colorByPoint: true
        //         }
        //     },
        //     series: [{
        //         name: 'Sponsor Equity',
        //         data: [5]
        //     }, {
        //         name: 'Investor Equity (INVESTOR)',
        //         data: [2]
        //     }, {
        //         name: 'Senior Loan',
        //         data: [3]
        //     }]
        // });
        //
        // // Price Chart
        // new Chart(document.getElementById("doughnut-chart"), {
        //     type: 'doughnut',
        //     data: {
        //         labels: ["Purchase Price", "Stamp Duty", "Brokerage", "Legal Fee", "Reserves"],
        //         datasets: [{
        //             label: "Population (millions)",
        //             backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
        //             data: [2478, 5267, 734, 784, 433]
        //         }]
        //     },
        //     options: {
        //         title: {
        //             display: true,
        //             text: 'Predicted world population (millions) in 2050'
        //         }
        //     }
        // });

        // $(function () {
        //     $("#map").googleMap({
        //                             zoom  : 15, // Initial zoom level (optional)
        //                             coords: [17.438136, 78.395246], // Map center (optional)
        //                             type  : "ROADMAP" // Map type (optional)
        //                         });
        // })

        // graph Chart
        // $(function() {
        //     $('#graph').graphify({
        //         start: 'bar', // //type of graph to start with
        //         obj: {
        //             id: 'ggg',
        //             height: 350,
        //             xGrid: false, // False will remove vertical <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a> lines
        //             legend: true, // Show a legend?
        //             title: 'Distribution',
        //             points: [
        //                 [7, 26, 33, 74, 12, 49, 33]
        //             ],
        //             pointRadius: 3,
        //             colors: ['#4a69bd'],
        //             xDist: 90, // Horizontal distance between vertical grid lines (Makes graph wider)
        //             dataNames: ['Distribution'],
        //             xName: 'Day', // Name of X-Axis
        //             tooltipWidth: 1,
        //             animations: true,
        //             averagePointRadius: 10,
        //             design: {
        //                 tooltipColor: '#fff',
        //                 gridColor: 'grey',
        //                 tooltipBoxColor: 'green',
        //                 averageLineColor: 'green',
        //                 pointColor: 'green',
        //                 lineStrokeColor: 'grey',
        //             }
        //         }
        //     });
        // });
    </script>

    <script>
        document.querySelectorAll('.thumbnail-selector').forEach(function(thumb) {
            thumb.addEventListener('click', function () {
                const mainImg = document.getElementById('mainImage');
                mainImg.src = this.src;
            });
        });
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
