@extends('admin.layout.base')

@section('title', 'Edit Coin ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.coin.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a>

            <h5 style="margin-bottom: 2em;">Edit Coin</h5>

            <form class="form-horizontal" action="{{route('admin.coin.update', $Coin->id )}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Coin Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $Coin->coin_name }}" name="coin_name" required id="coin_name" placeholder="Coin Name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="symbol" class="col-xs-2 col-form-label">Coin Symbol</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $Coin->symbol }}" name="symbol" required id="symbol" placeholder="Coin Symbol">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-xs-2 col-form-label">Coin Order</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $Coin->sort_order }}" name="sort_order" required id="sort_order" placeholder="Coin Order">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-12 col-form-label">Token or Not</label>
                    <div class="col-xs-10">
                        <input type="checkbox" name="coin_type" id="coin_type" @if($Coin->coin_type==1) checked @endif /> Yes
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-12 col-form-label">Contract Address</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="contract_address"  id="contract_address" placeholder="Contract Address" value="{{ $Coin->contract_address }}" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-12 col-form-label">Address</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" name="address"  id="address" placeholder="Address" value="{{ $Coin->address }}"> 
                    </div>
                </div>

                <div  class="form-group ">
                    <p class="alert alert-info col-xs-10"><b>Note:</b> Please check your address once and twice before submit...</p>
                </div>

                <div class="form-group row">
                    <label for="qr_code" class="col-xs-2 col-form-label">
                   Coin Icon</label>
                    <div class="col-xs-10">
                        @if($Coin->image !='')
                        <img style="height: 90px; margin-bottom: 15px;" src="{{ img($Coin->image) }}">
                        @endif
                        <input type="file" accept="image/*" name="image" class="form-control-file" id="image" aria-describedby="fileHelp">
                    </div>
                </div>

            
                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('admin.coin.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                Update Coin</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
