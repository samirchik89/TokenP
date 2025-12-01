@extends('admin.layout.base')

@section('title', 'Edit Worth Status')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <a href="{{ route('admin.worthstatus') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">Edit Worth Status</h5>

            <form class="form-horizontal" action="{{route('admin.updateworthstatus')}}" method="POST" enctype="multipart/form-data" role="form">
                
                {{csrf_field()}}

                <input type="hidden" name="id" value="{{$worthstatus->id}}">
                
                <div class="form-group row">
                    <label for="promo_code" class="col-xs-2 col-form-label">Worth Status</label>
                    <div class="col-xs-10">
                        <input class="form-control" autocomplete="off"  type="text" name="worth_status" value="{{$worthstatus->worth_status}}" required id="worth_status" placeholder="Enter Fund Type">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Status</label>
                    <div class="col-xs-10">
                       <select id="status" name="status" class="form-control">
                           <option value="0" @if($worthstatus->status==0) selected @endif >Inactive</option>
                           <option value="1"  @if($worthstatus->status==1) selected @endif > Active</option>
                       </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="zipcode" class="col-xs-2 col-form-label"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary">Add</button>
                        
                        <a href="{{route('admin.worthstatus')}}" class="btn btn-default">@lang('admin.cancel')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
