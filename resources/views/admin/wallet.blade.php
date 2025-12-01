@extends('admin.layout.base')

@section('title', 'Admin Wallets')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5> Admin Wallets</h5>

                <form class="form-horizontal" action="{{ url('admin/admin_wallet') }}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">@lang('admin.ripple_addr') (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('admin_address_eth') }}" name="admin_address_eth" id="admin_address" placeholder="@lang('admin.ripple_addr')" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">@lang('admin.ripple_addr') (BNB)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('admin_address_bnb') }}" name="admin_address_bnb" id="admin_address" placeholder="@lang('admin.ripple_addr')" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">@lang('admin.ripple_addr') (MATIC)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('admin_address_matic') }}" name="admin_address_matic" id="admin_address" placeholder="@lang('admin.ripple_addr')" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">USDC (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('admin_usdc_address') }}" name="admin_usdc_address" id="admin_address" placeholder="@lang('admin.ripple_addr')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">USDT (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('admin_usdt_address') }}" name="admin_usdt_address" id="admin_address" placeholder="@lang('admin.ripple_addr')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">DIE (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('admin_die_address') }}" name="admin_die_address" id="admin_address" placeholder="@lang('admin.ripple_addr')" required>
                        </div>
                    </div>

                    <h5>Stable token address</h5>

                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">USDT (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('usdt_address') }}" name="usdt_address" id="admin_address"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">USDC (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('usdc_address') }}" name="usdc_address" id="admin_address"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="admin_address" class="col-xs-2 col-form-label">DIE (ETH)</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ Setting::get('die_address') }}" name="die_address" id="admin_address"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zipcode" class="col-xs-2 col-form-label"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Update Address</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
