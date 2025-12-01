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
        .property-list-sec .container {
            width: 100% !important;
        }
    </style>

    <div class="content-page-inner">
        <!-- Breadcrumb -->

        @if (Auth::check())
            <div class="page-content">
                <!-- Header Banner Start -->
                <div class="header-breadcrumbs">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6"><h1>Property List</h1></div>
                            <div class="col-sm-6">
                                @include('issuer.layout.breadcrumb',['items'=>[
                                    ['title'=>'Home','url'=>url('/dashboard')],
                                    ['title'=>'Property List']
                                ]])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <img src="/asset/img/buildings.jpg" style="width:100%; height: 400px; object-fit: cover; object-position: center;">
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row" style="margin-top: 50px">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center">
                <h1 style="font-size: 40px">Premium Projects, Promising Returns—Your Investment Starts Here</h1>
            </div>
            <div class="col-md-1"></div>
        </div>

        <div class="page-content">
            <div class="content">
                <div class="page-content wizard-border">

                    <!-- Property List Starts -->
                    <div class="property-list-sec white-bg pos-rel">
                        <div class="container">

                            <div class="row property-para">
                                <div class="col-sm-12">
                                    @if (Auth::check())
                                        <p>
                                            Welcome to investment page. Please review details of currently listed offerings below and if you are ready to invest in a offering, click on “Ready to Invest” button to get the process started. Make sure you have sufficient funds in your wallet. For more details visit wallet page and deposit funds in your wallet.
                                        </p>
                                    @else
                                        <p>Don't forget, to start investing you must first <strong>"Become A Member"</strong>. All
                                            you need to submit is a first/last name, email address and create your own password.
                                            Membership will provide you greater financial details related to our offerings, give you
                                            instant updates and additional support from our on-boarding customer service team.</p>
                                    @endif

                                </div>
                            </div>


                            <div class="pro-list-wrap row mt60" id="list">
                                @foreach ($property as $key => $value)

                                    <!-- Property Box Starts -->
                                    <div class="col-md-4 mb-8">
                                        <div class="card h-100">

                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title m-0 me-2">{{ @$value->propertyName }}</h5>
                                                <h6 class="card-subtitle">
                                                    (
                                                    @if($value->token_type == 1)
                                                        Property Token
                                                    @elseif($value->token_type == 2)
                                                        Asset Token
                                                    @elseif($value->token_type == 3)
                                                        Utility Token
                                                    @endif
                                                    )
                                                    <p class="mb-0 mt-1" style="clear: both; margin-top: 0;">{{ @$value->propertyLocation }}</p>
                                                </h6>
                                            </div>

                                            <div class="card-body">
                                            <div class="pro-img pos-rel">
                                                @php
                                                    $firstImage = $value->propertyImages->first();
                                                    $image = $firstImage ? asset('storage/' . $firstImage->image) : asset('asset/package/images/building.jpg');
                                                @endphp
                                                <img src="{{ $image }}" alt="" class="img-fluid w-100" style="height: 170px; object-fit: cover;">
                                            </div>

                                            <div class="pro-details">
                                                <div class="property-progress mb-12">
                                                    <div class="pro-progress-block mb-8">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{ @$value->sold_percentage }}%;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="progress-txt fw-bold"><b class="text-primary">{{ @number_format($value->sold_percentage, 2) }}%
                                                            FUNDED</b> ${{ @$value->accuired_usd }} OF
                                                        ${{ @$value->totalDealSize }}</div>
                                                </div>
                                                <div class="pro-details-2">
                                                    @if ($value->token_type == 1)
                                                        <div class="row pro-det-list m-0">
                                                            <div class="col-md-6 col-xs-12 p-0">
                                                                <p class="pro-det-txt1 pro-det-txt">
                                                                    <b>Asset Type:</b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6 col-xs-12 p-0">
                                                                <p class="pro-det-txt2 pro-det-txt">{{ @$value->propertyType }}
                                                                </p>
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
                                                                <b>Total Tokens:</b>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt2 pro-det-txt">{{ @$value->userContract->tokensupply ?? 0}} {{@$value->userContract->tokensymbol}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row pro-det-list m-0">
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt1 pro-det-txt">
                                                                <b>Remaining Tokens:</b>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt2 pro-det-txt">{{ @$value->userContract->tokenbalance ?? @$value->userContract->tokensupply}} {{@$value->userContract->tokensymbol}}</p>
                                                        </div>
                                                    </div>
                                                    <!-- Property Details List Ends -->
                                                    <!-- Property Details List Starts -->
                                                    <div class="row pro-det-list m-0">
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt1 pro-det-txt"><b>Expected  Return<a
                                                                        class="tooltip_sto"
                                                                        title="Internal Rate of Return"> </a>:</b></p>
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
                                                    @if($value->userContract->contract_address && $value->contract_link)
                                                    <div class="row pro-det-list m-0">
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt1 pro-det-txt"><b>Contract Address:</b></p>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt2 pro-det-txt">
                                                                <a href="{{ $value->contract_link }}"
                                                                   target="_blank"
                                                                   rel="noopener noreferrer"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="{{ $value->userContract->contract_address }}"
                                                                   class="contract-link">
                                                                    {{ substr($value->userContract->contract_address, 0, 6) . '...' . substr($value->userContract->contract_address, -4) }}
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif



                                                    <!-- Property Details List Ends -->
                                                    <!-- Property Details List Starts -->
                                                    <div class="row pro-det-list m-0">
                                                        <div class="col-md-6 col-xs-12 p-0">
                                                            <p class="pro-det-txt1 pro-det-txt"><b>Asset Status:</b></p>
                                                        </div>

                                                        @if ($value->property_state == 'live')
                                                            <div class="col-md-6 col-xs-12 p-0">
                                                                <p class="pro-det-txt2 pro-det-txt">Funding Live</p>
                                                            </div>
                                                        @else
                                                            <div class="col-md-6 col-xs-12 p-0">
                                                                <p class="pro-det-txt2 pro-det-txt">Coming soon</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!-- Property Details List Ends -->
                                                </div>

                                                    <div class="text-center">
                                                        <a href="{{ url('propertyDetail/' . $value->id) }}"
                                                            class="view-btn btn btn-primary">View Details</a>
                                                    </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Property Box Ends -->
                                @endforeach
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
    // Method 1: Standard Bootstrap 4 initialization
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-bs-toggle="tooltip"]').tooltip();
});

// Method 2: Force initialization on specific elements
$(document).ready(function(){
    $('.contract-link').tooltip({
        placement: 'top',
        trigger: 'hover focus'
    });
});

// Method 3: Vanilla JavaScript fallback
document.addEventListener('DOMContentLoaded', function() {
    // Check if Bootstrap tooltip is available
    if (typeof $.fn.tooltip !== 'undefined') {
        $('[data-toggle="tooltip"], [data-bs-toggle="tooltip"]').tooltip();
    }
});
</script>
@endsection
