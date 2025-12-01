@extends('layout.app')

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
    </style>
    <!-- Breadcrumb -->
    <div class="page-content">
        <section class="pro-title-bread-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pro-title-bread-inner">
                            <div class="">
                                <h2 class="pro-head-tit">{{ @$property->propertyName }}</h2>
                                <p class="pro-head-txt m-0">{{ @$property->propertyLocation }}</p>
                            </div>
                            <div class="">
                                <div class="apply-btn-wrap text-right"> <!-- {{ url('applyInvest/'.$property->id) }} -->
                                    @if (Auth::check())
                                    @if($property->property_state == 'comingsoon')
                                    <a class="apply-btn" style="cursor:default">
                                        Coming Soon
                                    </a>
                                    @else
                                        <a href="{{ url('applyInvest/'.$property->id) }}" class="apply-btn">
                                            Ready to Invest
                                        </a>
                                        @endif
                                    @else
                                        <a href="/profile" class="apply-btn">
                                            Buy Property
                                        </a>
                                        @endif
                                        </br>
                                        @if (Auth::check())
                                            <small style="color: #b9b9b9">Note: Please update the profile information before investing.</small>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="property-content">
            <div class="container">

                <!-- Property Image Section Starts -->
                <div class="property-img-sec row">
                    <!-- Property-img-box Starts -->
                    <div class="col-md-6 left-col">
                        <!-- Slider Start -->
                        <div class="form-group col-md-12" style="padding:60px; padding-left:30px;padding-top:0px">
                        <div class="form-group">
                            <img src="{{ @img($property->propertyLogo) }}" style="width: 100%">
                        </div>
                        </div>

                        <!-- Slider End -->


                    </div>
                    <!-- Property-img-box Ends -->
                    <!-- Property Image Right Starts -->
                    <div class="col-md-6 right-col">
                        <div class="property-img-right">
                            <div class="property-rig-card">
                                {{-- <div>
                                    <h5 class="target-txt">Targets</h5>

                                    <div class="property-progress">
                                        <div class="pro-progress-block">
                                            <div class="progress-value" @if ($property->accuired_percentage < 100)
                                                style="width: {{ @$property->accuired_percentage }}%;" @else style="width: 100%;"
                                            @endif >
                                            </div>
                                        </div>
                                        <span class="progress-txt"><b>{{ price_format(@$property->accuired_percentage, 2) }}% FUNDED</b> ${{ @$property->accuired_usd }} OF ${{ @$property->totalDealSize }}</span>
                                    </div>
                                </div> --}}
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
                                            <p class="pro-detail-txt pro-detail-txt-2">{{ @$property->fundedMembers }}</p>
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
                                <!-- Property Detail Box Ends -->
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
                        </div>
                    </div>
                    <!-- Property Image Right Ends -->
                </div>
                <!-- Property Image Section Ends -->
            </div>
        </div>


        <section class="container table-property">

            <table class="datatable-full table table-striped table-bordered custom-table-style"
                cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Purchase Dt</th>
                        <th>Token Price</th>
                        <th>No of Token</th>
                        <th>Total Token Value</th>
                        <th>Paid By</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $token)
                        <tr>
                            <td>
                                <a href="{{ url('/viewproperty', $token->id) }}" >{{ @$token->usercontract->property->propertyName }}</a>
                            </td>
                            <td>{{ @date('Y-m-d', strtotime($token->updated_at)) }}</td>
                            <td>{{ @$token->usercontract->tokenvalue }}$</td>
                            <td>{{ @$token->number_of_token }} {{ @$token->tokenSymbol }}</td>
                            <td>{{ number_format(@$token->number_of_token * @$token->usercontract->tokenvalue, 6, '.', '') }}$</td>
                            <td>{{ @$token->payment_type }}</td>
                            @if(@$token->status=='3')
                            <td style="color:#0c678b;">Awaiting Confirmation from Tazapay</td>
                            @elseif(@$token->status=='2')
                            <td style="color:orange">Token Transfer Pending</td>
                            @elseif(@$token->status=='1')
                            <td style="color:green">Success</td>
                            @else
                            <td style="color:red">Failed</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
    </div>
@endsection