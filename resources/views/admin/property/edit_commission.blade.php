@extends('admin.layout.base')

@section('title', 'Property Commission')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;">Update Property Commission</h5>

            <form class="form-horizontal" action="{{ url('/admin/edit_commission') }}" method="POST" role="form">
            	{{csrf_field()}}

            	<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Property Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="name" value="{{$property->propertyName}}" readonly>
                        <input class="form-control" type="hidden" name="id" value="{{$property->id}}">
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Commission (%)</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="interest" value="{{$property->interest}}" required>
					</div>
				</div>
                <div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Commission</button>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
