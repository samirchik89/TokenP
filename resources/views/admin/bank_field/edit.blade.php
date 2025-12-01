@extends('admin.layout.base')

@section('title', 'Change Password ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;">Add Bank Fields</h5>

            <form class="form-horizontal" action="{{ url('/admin/update_bank_fields') }}" method="POST" role="form">
            	{{csrf_field()}}
                <input type="hidden" value="{{$field->id}}" name="id">
            	<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Field Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="name" value="{{$field->name}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Account Number</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="account_number" value="{{$field->account_number}}">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Branch Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="branch_name" value="{{$field->branch_name}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Account Holder Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="account_name" value="{{$field->account_name}}">
					</div>
				</div>
				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Field</button>
					</div>
				</div>

			</form>
		</div>
    </div>
</div>

@endsection
