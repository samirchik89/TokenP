@extends('layout.app')

@section('content')
<!-- Breadcrumb -->
<div class="page-content">
    <div class="pro-breadcrumbs">
        <div class="container">
            <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
            <span>/</span>
            <a href="#" class="pro-breadcrumbs-item">Sell Token</a>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- Property Head Starts -->
    <div class="property-head grey-bg pt30">
        <div class="container">
            <div class="property-head-btm row">
                <div class="col-md-12">
                    <h2 class="pro-head-tit">Sell Token</h2>
                    <p class="pro-head-txt">Houston, TX</p>
                    <div>
                        <span class="detail-badge">Stabilized Occupancy</span>
                        <span class="detail-badge">Stabilizied Cashflow</span>
                        <span class="detail-badge">Below Market Rents</span>
                        <span class="detail-badge">NOI Growth </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property Head Ends -->

    <div class="page-content">
        <!-- Property List Starts -->
        <div class="property-list-sec white-bg pos-rel">
            <div class="container">
                <div class="pro-list-wrap row card-spaceall">
                    <!-- Property Box Starts -->
                    <div class="col-md-6 card-me">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Prestige Polygon</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row text-center tbl-sen">
                                    <div class="col-md-6 tbl-sen-l">
                                        <table class="table" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td class="td-first">Tokens:</td>
                                                    <td class="td-secound">12</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-first">Yield:</td>
                                                    <td class="td-secound">12%</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-first">Risk:</td>
                                                    <td class="td-secound">High </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 tbl-sen-r">
                                        <table class="table" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td class="td-first">Quoted Price:</td>
                                                    <td class="td-secound">100$</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-first">Possession:</td>
                                                    <td class="td-secound">12 <a class="tooltip_sto tooltipstered">M</a> </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-first"> Cap gain:</td>
                                                    <td class="td-secound">12%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 tbl-sen-r offer_pricetbl">
                                        <table class="table" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td class="td-first"> Offer Price :</td>
                                                    <td class="td-secound"> $2094</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-first"> No of tokens :</td>
                                                    <td class="td-secound"> 124</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="row view-sell-btn">
                                    <div class="col-md-12" align="center">

                                        <a href="{{url('/wallet')}}">
                                            <button type="button" class=" btn1 btn2">List Token</button>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Property Box Ends -->

                </div>
            </div>
        </div>
        <!-- Property List Ends -->
    </div>
</div>
@endsection


@section('scripts')

@endsection
