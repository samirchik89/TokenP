@extends('layout.app')

@section('content')
<style>
.main-timeline {
    position: relative;
    overflow: hidden;
}

.main-timeline:before {
    content: "";
    width: 0px;
    height: 93%;
    border-right: 3px solid #222222f5;
    position: absolute;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
}

.main-timeline .timeline {
    width: 50.1%;
    float: right;
    padding: 15px 20px 15px 50px;
    position: relative;
}

.main-timeline .timeline:before {
    content: "";
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #222222f5;
    border: 5px solid #fff;
    box-shadow: 0 0 0 3px #222222f5;
    position: absolute;
    top: 25px;
    left: -4px;
}

.main-timeline .timeline-content {
    display: block;
    position: relative;
    text-align: center;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 5px 40px 0 rgb(0 0 0 / 11%);
    background: rgb(0 0 0 / 3%);
}

.main-timeline .title i {
    display: inline-block;
    font-size: 30px;
    margin-left: 5px;
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
}

.main-timeline .description {
    padding: 0 15px;
    font-size: 15px;
    color: #000;
    letter-spacing: 1px;
    margin: 0 0 5px 0;
}

.main-timeline .timeline:nth-child(2n) {
    float: left;
    padding: 15px 50px 15px 20px;
}

.main-timeline .timeline:nth-child(2n):before {
    left: auto;
    right: -6px;
}

.main-timeline .timeline:nth-child(2n) .timeline-content {
    text-align: center;
}

.main-timeline .timeline:nth-child(2n) .title 
{
    margin: 0;
    font-size: 16px;
    color: #000;
    font-weight: 500;
}
.timeline-content h3
{
    margin: 0;
    font-size: 16px;
    color: #000;
    font-weight: 500;
}
.main-timeline .timeline:nth-child(2n) .title i {
    right: auto;
    left: 15px;
}

section.flow_chart 
{
    padding: 100px 0px;
}
.flow_chart_inner_box
{
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 5px 40px 0 rgb(0 0 0 / 11%);
    border: none;
    padding: 40px 20px;
}

</style>

<!-- Breadcrumb -->
    <div class="page-content">

        <div class="pro-breadcrumbs">
            <div class="container">
                <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
                <span>/</span>
                <a href="#" class="pro-breadcrumbs-item">Flow Chart</a>
            </div>
        </div>
        <!-- End Breadcrumb -->
        <!-- Property Head Starts -->
        <div class="property-head grey-bg pt30">
            <div class="container">
                <div class="property-head-btm row">
                    <div class="col-md-12">
                        <h2 class="pro-head-tit">Flow Chart</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property Head Ends -->

        <!-- Property Head Ends -->
        
        <section class="flow_chart">
            <div class="">
                <!-- Property List Starts -->
                <div class="property-list-sec pos-rel">
                  <div class="container">
                    <div class="row">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-sm-8 text-center animated bounceIn">
                            <div class="main-timeline flow_chart_inner_box">
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Process Flowchart</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Investor Prospectus</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">KYC</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Accredition Verification</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Create Your Wallet</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Agreement</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Make Invesment</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Check Status</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Claim Token</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Voting</h3>
                                    </a>
                                </div>
                                <div class="timeline">
                                    <a href="#" class="timeline-content">
                                        <h3 class="title">Dividend Issuance</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- Property List Ends -->
            </div>
        </section>

    </div>
@endsection


@section('scripts')

@endsection
