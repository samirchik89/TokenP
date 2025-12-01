@extends('admin.layout.base')

@section('title', 'Change Password ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;">Add Bank Details</h5>

            <form class="form-horizontal" action="{{ url('/admin/add_bank_details') }}" method="POST" role="form">
            	{{csrf_field()}}

                @foreach($fields as $index => $field)
            	<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">{{$field->name}}</label>
					<div class="col-xs-10">
                        @if($index == 0)
						<input class="form-control" type="text" required name="{{$index+1}}" id="{{$field->name}}" value="{{ Setting::get('bank_name') }}">
                        @elseif($index == 1)
                        <input class="form-control" type="text" required name="{{$index+1}}" id="{{$field->name}}" value="{{ Setting::get('ifsc_code') }}">
                        @elseif($index == 2)
                        <input class="form-control" type="text" required name="{{$index+1}}" id="{{$field->name}}" value="{{ Setting::get('other_details') }}">
                        @else
                        <input class="form-control" type="text" required name="{{$index+1}}" id="{{$field->name}}" value="">
                        @endif
					</div>
				</div>
                @endforeach

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Add Details</button>
					</div>
				</div>

			</form>
		</div>
    </div>
</div>

@endsection
