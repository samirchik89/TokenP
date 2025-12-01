@extends('admin.layout.base')

@section('title', 'Add Fund Type')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

            <a href="{{ route('admin.fund') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Add Fund Type</h5>

            <form class="form-horizontal" action="{{route('admin.storefund')}}" method="POST" enctype="multipart/form-data" role="form">
            	
            	{{csrf_field()}}

				<div class="form-group row">
					<label for="promo_code" class="col-xs-2 col-form-label">Fund Type</label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" name="fund_type" required id="fund_type" placeholder="Enter Fund Type">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Add</button>
						
						<a href="{{route('admin.fund')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
