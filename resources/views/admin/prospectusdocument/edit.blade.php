@extends('admin.layout.base')

@section('title', 'Update Document ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('admin.prospectusdocument.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.update_doc')</h5>

            <form class="form-horizontal" action="{{route('admin.prospectusdocument.update', $document->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
				<div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">@lang('admin.doc_name')</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $document->title }}" name="title" required id="title" placeholder="Document Name">
					</div>
				</div>

				  <div class="form-group row">
                    <label for="order" class="col-xs-2 col-form-label">@lang('admin.doc_order')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $document->order }}" order="order" required id="order" placeholder="Document order" name="order">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="image" class="col-xs-2 col-form-label">@lang('admin.doc_file')</label>
                    <div class="col-xs-10">

                    	@if($document->document !='')
	                    <a href="{{ img($document->document) }}" >Download</a>
	                    @endif
                        
                        <input type="file"  name="document" class="dropify form-control-file" id="document" aria-describedby="fileHelp" value="{{ $document->document }}">
                    </div>
                </div>

				<div class="form-group row">
					<label class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.update_doc')</button>
						<a href="{{route('admin.prospectusdocument.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
