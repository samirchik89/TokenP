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
            <div class="container" style="padding: 16px;">
                <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
                <span>/</span>
                <a href="#" class="pro-breadcrumbs-item">Our Company</a>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Property Head Starts -->
        <div class="property-head grey-bg pt30">
            <div class="container">
                <div class="property-head-btm row">
                    <div class="col-md-12">
                        <h2 class="pro-head-tit" style="padding:0px 9px">Our Company</h2>
                    
                        <div class="col-sm-12">
                           
                            <p>Unlike the current process for investing capital, which requires large amounts of time and costs for due diligence, {{ Setting::get('site_title') }} only lists complete projects that have passed the most stringent level of due diligence and have appropriate insurances in place.</p>
                        
                    </div>

                    <div class="col-sm-12">
                           
                        <p>{{ Setting::get('site_title') }} is a regulatory compliant platform that operates in partnership with SEC / FINRA licensed brokerages and transfer agents. Our financial platform promises to provide the modern investment experience investors deserve.</p>
                    
                </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property Head Ends -->

        
@endsection


@section('scripts')

@endsection
