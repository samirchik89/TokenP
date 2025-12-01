@extends('admin.layout.base')

@section('title', 'User Documents ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">


        <div class="box box-block bg-white">

                      <!-- Account List Box Starts -->

                      <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.coin')</th>
                        <th>@lang('admin.value')</th>
                        <!-- <th>@lang('admin.action')</th> -->
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="{{asset('img/bit-1.png')}}" style="height: 50px; width: 50px;"></td>
                            <td>@if($BTC)
                                                            {{$BTC->value}} {{$BTC->coin}}
                                                        @else
                                                            0 BTC
                                                        @endif</td>

                        </tr>



                         <tr>
                            <td>3</td>
                            <td><img src="{{asset('img/ethereum.png')}}" style="height: 50px; width: 50px;"></td>
                            <td>@if($ETH)
                                                            {{$ETH->value}} {{$ETH->coin}}
                                                        @else
                                                            0 MATIC
                                                        @endif</td>


                        </tr>



                         <tr>
                            <td>5</td>
                            <td><img src="{{asset('img/ripple.png')}}" style="height: 50px; width: 50px;"></td>
                            <td>@if($XRP)
                                                            {{$XRP->value}} {{$XRP->coin}}
                                                        @else
                                                            0 XRP
                                                        @endif</td>


                        </tr>



                          <tr>
                            <td>2</td>
                            <td><img src="{{asset('img/bit.png')}}" style="height: 50px; width: 50px;"></td>
                            <td>@if($WIRE)
                                                            {{$WIRE->value}}  BANK TRANSFER
                                                        @else
                                                            0 BANK TRANSFER
                                                        @endif</td>

                        </tr>

                         <tr>
                            <td>2</td>
                            <td><img src="{{asset('img/lgc2.png')}}" style="height: 50px; width: 50px;"></td>
                            <td>@if($WALLET)
                                                            {{$WALLET->wallet}} USD WALLET
                                                        @else
                                                            0 USD WALLET
                                                            @endif

                        </tr>



                </tbody>

            </table>




        </div>
    </div>
</div>
@endsection
