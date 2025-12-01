@extends('admin.layout.base')

@section('title', 'Add Document ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.prospectusdocument.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back') </a>

            <h5 style="margin-bottom: 2em;">@lang('admin.add_doc')</h5>

            <form class="form-horizontal" action="{{route('admin.prospectusdocument.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="name" class="col-xs-12 col-form-label">@lang('admin.doc_name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('name') }}" name="title" required id="title" placeholder="@lang('admin.doc_name')">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="order" class="col-xs-12 col-form-label">@lang('admin.doc_order')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ old('order') }}" order="order" required id="order" placeholder="@lang('admin.doc_order')" name="order">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-xs-12 col-form-label">@lang('admin.doc_file') </label>
                    <div class="col-xs-10">                        
                        <input type="file" name="document" class="dropify form-control-file" id="document" aria-describedby="fileHelp">
                    </div>
                </div>        

                <div class="form-group row">
                    <label class="col-xs-12 col-form-label"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary">@lang('admin.add_doc')</button>
                        <a href="{{route('admin.prospectusdocument.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
