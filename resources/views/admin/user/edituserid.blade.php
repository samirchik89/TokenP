@extends('admin.layout.base')

@section('title', 'Update User')

@section('content')

<!-- edit page -->
<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.user.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a>

			<h5 style="margin-bottom: 2em;">Update User</h5>

            <form class="form-horizontal" action="{{url('admin/user/edituseridstore')}}" method="POST" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="id" value="{{$user->id}}">
				<div class="form-group row">
					<label for="first_name" class="col-xs-2 col-form-label">First Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->first_name }}" id="first_name" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-xs-2 col-form-label">Last Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->last_name }}" id="last_name" readonly>
					</div>
				</div>				

				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">GIFTZ ID</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $user->membership }}" name="membership" required id="membership" placeholder="GIFTZ ID" minlength="6" maxlength="20">
					</div>
				</div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update User</button>
						<a href="{{route('admin.user.index')}}" class="btn btn-default">Cancel</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
