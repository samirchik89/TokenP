@extends('admin.layout.base')

@section('title', 'Property Asset Types')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">

            <div class="box box-block bg-white">

                <h5 class="mb-1">Property Asset Types</h5>

                <a href="{{ route('admin.property.createasset') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>Asset Type</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $key => $asset)
                            <tr>
                                <td>{{ @$key + 1}}</td>
                                <td>{{ $asset->type }}</td>
                                <td>
                                    <a href="{{ route('admin.property.editasset', $asset->id) }}"><button class="btn btn-primary">Edit</button></a>
                                    <a href="{{ route('admin.property.deleteasset', $asset->id) }}"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
