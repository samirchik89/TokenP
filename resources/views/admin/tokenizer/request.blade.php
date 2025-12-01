@extends('admin.layout.base')

@section('title', 'Token Request')

@section('content')


<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <table class="table table-striped table-bordered dataTable" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>User</th>
                        <th>Token Name</th>
                        <th>Token Symbol</th>
                        <th>Token Value</th>
                        <th>Token Supply</th>
                        <th>Token Network</th>
                        <th>Contract Address</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($contracts as $index => $value)

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ @(!is_null($value->user->name)) ? $value->user->name : 'Admin'  }}</td>
                        <td>{{ @$value->name }}</td>
                        <td>
                            <a href="{{ url('admin/get_property_details', $value->property_id) }}">{{ @$value->symbol }}</a>
                        </td>
                        <td>{{ price_format(@$value->usdvalue, 2) }}</td>
                        <td>{{ price_format(@$value->supply, 2) }}</td>
                        <td>{{ $value->coin }}</td>
                        <td>
                            @if (@$value->status != 'pending')
                                @if($value->coin == 'MATIC')
                                <a href="https://amoy.polygonscan.com/token/{{@$value->usercontract->contract_address}}" target="_blank">Click to View</a>
                                @elseif($value->coin == 'BNB')
                                <a href="https://testnet.bscscan.com/token/{{@$value->usercontract->contract_address}}" target="_blank">Click to View</a>
                                @else
                                <a href="https://sepolia.etherscan.io/token/{{@$value->usercontract->contract_address}}" target="_blank">Click to View</a>
                                @endif
                            @else
                                ---
                            @endif
                        </td>
                        @if($value->property->interest != null || $value->status == 'live')
                            @if (@$value->status != 'pending')
                                <td>
                                    Token {{@$value->status}}
                                </td>
                            @else
                                <td> <a href="{{route('admin.issuertokencontracttest',$value->id)}}" class="btn btn-info"> ADD </a>
                                    <a href="{{route('admin.issuerReqTokenDetails',$value->property_id)}}" class="btn btn-warning"> VIEW </a>
                                    <a href="{{route('admin.issuertokenreject',$value->id)}}" class="btn btn-danger"> REJECT </a>
                            </td>
                            @endif
                        @else
                            <td>
                                <a href="#" data-toggle="modal" data-target="#exampleModal{{$index}}" class="btn btn-primary">Update Commission</a>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @foreach($contracts as $index => $value)
            <!-- Model start -->
            <div class="modal fade" id="exampleModal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog df-modal-xl" role="document">
                    <div class="modal-content" style="">
                    <div class="modal-header deposit-fiat-header">
                        <h4 class="modal-title" id="exampleModalLabel">Update Commission</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="deposit-fiat-form" method="post" action="{{ url('admin/update_interest') }}" enctype="multipart/form-data">
                    @csrf()
                        <div class="deposit-fiat-box df-box-1">
                            <div class="row">
                                <div class="df-heading">
                                    <h4>Property Details</h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group bk-form-group">
                                                <label class="df-lable" for="propertyName">Name</label>
                                                <span class="bk-m-colon">:</span>
                                                <p class="df-value" id="BankName">{{$value->name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group bk-form-group">
                                                <label class="df-lable" for="propertyLocation">Symbol</label>
                                                <span class="bk-m-colon">:</span>
                                                <p class="df-value" id="IFSC_code">{{$value->symbol}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group bk-form-group">
                                                <label class="df-lable" for="propertyLocation">Token value</label>
                                                <span class="bk-m-colon">:</span>
                                                <p class="df-value" id="AccountNumber">$ {{$value->usdvalue}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group bk-form-group">
                                                <label class="df-lable" for="propertyLocation">Supply</label>
                                                <span class="bk-m-colon">:</span>
                                                <p class="df-value" id="BranchName">{{$value->supply}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="deposit-fiat-box">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="df-lable" for="propertyLocation"><b>Commission</b></label>
                                        <input class="form-control" type="number" name="interest" required placeholder="Enter your commission percentage">
                                        <input class="form-control" type="hidden" name="id" value="{{$value->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
                <!-- Modal end  -->
            @endforeach
        </div>
    </div>
</div>
@endsection
