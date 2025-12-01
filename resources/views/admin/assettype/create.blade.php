@extends('admin.layout.base')

@section('title', 'Create Asset Type')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

            <a href="{{ route('admin.property.showasset') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">Create Property Asset Type</h5>

            <form class="form-horizontal" action="{{route('admin.property.storeasset')}}" method="POST" enctype="multipart/form-data" role="form">            	
            	{{csrf_field()}}
				<div class="form-group col-md-8">
					<label for="" class="col-form-label">Property Type</label>					
					<input class="form-control" type="text" name="propertytype" required id="propertytype" placeholder="Enter Property Type">
				</div>				

				<div class="form-group row">
				<br>				
				<br>				
					<label for="" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="{{route('admin.property.showasset')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection