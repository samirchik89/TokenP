@extends('layout.app')

@section('content')
    <style>
        .site_img {
            padding: 30px 0px;
        }
        .asset_rwo {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
        }
        .no-padding {
            padding: 25px 0px !important;
        }
    </style>

    <!-- Breadcrumb -->
    <div class="page-content">
        <div class="pro-breadcrumbs">
            <div class="container">
                <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
                <span>/</span>
                <a href="#" class="pro-breadcrumbs-item">Asset List</a>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Property Head Starts -->
        <div class="property-head grey-bg pt30">
            <div class="container">
                <div class="property-head-btm row">
                    <div class="col-md-12">
                        <h2 class="pro-head-tit">Asset List</h2>
                        <p class="pro-head-txt">Houston, TX</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property Head Ends -->

        <div class="page-content">
        <!-- Property List Starts -->
            <div class="property-list-sec white-bg pos-rel">
                <div class="container">
                    <div class="pro-list-wrap row mt60">
                    @foreach ($property as $key => $value)
                        <!-- Property Box Starts -->
                            <div class="col-md-4">
                                <div class="pro-box equal-height">
                                    <div class="pro-badge-out"><span class="pro-badge">{{ @$value->status }}</span></div>
                                    <div class="pro-name">
                                        <h4>{{ @$value->propertyName }}</h4>
                                        <p>{{ @$value->propertyLocation }}</p>
                                    </div>
                                    <div class="pro-img pos-rel">
                                        @php $image = (!is_null($value->propertyLogo)) ? asset('storage/'.$value->propertyLogo) : asset('asset/package/images/building.jpg'); @endphp
                                        <img src="{{ @$image }}" alt="">
                                    </div>
                                    <div class="pro-details">
                                        <div class="property-progress">
                                            <div class="pro-progress-block">
                                                <div class="progress-value" @if ($value->accuired_percentage < 100)
                                                    style="width: {{ @$value->accuired_percentage }}%;" @else style="width: 100%;"
                                                @endif>

                                                </div>
                                            </div>
                                            <span class="progress-txt"><b>{{ @number_format($value->accuired_percentage, 2) }}% FUNDED</b> ${{ @$value->accuired_usd }} OF ${{ @$value->totalDealSize }}</span>
                                        </div>
                                        <div class="pro-details-2">
                                            @if($value->token_type == 1)
                                            <!-- Property Details List Starts -->
                                            <div class="row pro-det-list m-0">
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt1 pro-det-txt">
                                                        <b>Asset Type:</b>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt2 pro-det-txt">{{ @$value->propertyType }}</p>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row pro-det-list m-0">
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt1 pro-det-txt">
                                                        <b>Asset Type:</b>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt2 pro-det-txt">Asset Fund</p>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- Property Details List Ends -->
                                            <!-- Property Details List Starts -->
                                            <div class="row pro-det-list m-0">
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt1 pro-det-txt">
                                                        <b>Total Deal size:</b>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt2 pro-det-txt">${{ @$value->totalDealSize }}</p>
                                                </div>
                                            </div>
                                            <!-- Property Details List Ends -->
                                            <!-- Property Details List Starts -->
                                            <div class="row pro-det-list m-0">
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt1 pro-det-txt"><b>Expected <a class="tooltip_sto" title="Internal Rate of Return">Annual Return</a>:</b></p>
                                                </div>
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt2 pro-det-txt">{{ @$value->expectedIrr }}%</p>
                                                </div>
                                            </div>
                                            <!-- Property Details List Ends -->
                                            <!-- Property Details List Starts -->
                                            <div class="row pro-det-list m-0">
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt1 pro-det-txt"><b>Min Investment:</b></p>
                                                </div>
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt2 pro-det-txt">${{ @$value->initialInvestment }}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Property Details List Ends -->
                                            <!-- Property Details List Starts -->
                                            <div class="row pro-det-list m-0">
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt1 pro-det-txt"><b>Asset Status:</b></p>
                                                </div>
                                                <div class="col-md-6 col-xs-12 p-0">
                                                    <p class="pro-det-txt2 pro-det-txt">Funding Live</p>
                                                </div>
                                            </div>
                                            <!-- Property Details List Ends -->
                                        </div>
                                        <div class="text-center">
                                            <a href="{{url('propertyDetail/'.$value->id)}}" class="view-btn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Property Box Ends -->
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Property List Ends -->
        </div>
    </div>
@endsection


@section('scripts')

@endsection
