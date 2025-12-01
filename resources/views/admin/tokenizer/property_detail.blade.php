@extends('admin.layout.base')

@section('title', 'Property Detail')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;">Property Detail</h5>

            <form class="form-horizontal" action="#" method="POST" role="form">
            	{{csrf_field()}}

            	<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Property Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="name" value="{{$property->propertyName}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Token Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="name" value="{{@$property->userContract->tokenname}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Token Type</label>
					<div class="col-xs-10">
                        <?php
                           $type = $property->token_type == 1 ? 'Property' : 'Asset';
                        ?>
						<input class="form-control" type="text" name="type" value="{{$type}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Interest (%)</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="type" value="{{$property->interest}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Total supply</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="type" value="{{@$property->userContract->tokensupply}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Current Holding</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="type" value="{{@$property->userContract->tokenbalance}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Token selled</label>
					<div class="col-xs-10">
                        <?php
                            $sell = @$property->userContract->tokensupply - @$property->userContract->tokenbalance;
                        ?>
						<input class="form-control" type="text" name="type" value="{{$sell}}">
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
