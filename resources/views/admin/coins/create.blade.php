@extends('admin.layout.base')

@section('title', 'Add cointype Type ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.coin.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i>
                    Back</a>

                <h5 style="margin-bottom: 2em;">Add Coin</h5>

                <form class="form-horizontal" action="{{ route('admin.coin.store') }}" method="POST"
                    enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="name" class="col-xs-12 col-form-label">Coin Name</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" name="coin_name" required id="coin_name"
                                placeholder="Coin Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="symbol" class="col-xs-12 col-form-label">Coin Symbol</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text"name="symbol" required id="symbol"
                                placeholder="Coin Symbol">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <a href="{{ route('admin.coin.index') }}" class="btn btn-danger btn-block">Cancel</a>
                                </div>
                                <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">Add Coin Type</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
