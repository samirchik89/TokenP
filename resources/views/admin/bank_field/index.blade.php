@extends('admin.layout.base')

@section('title', 'Property Asset Types')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">

            <div class="box box-block bg-white">

                <h5 class="mb-1">List Fields Name</h5>

                <a href="{{ url('/admin/add_bank_fields') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Bank Name</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $asset)
                            <tr>
                                <td>{{ @$key + 1}}</td>
                                <td>{{ $asset->name }}</td>
                                <td>
                                    <a href="{{ url('admin/edit_bank_field',$asset->id) }}"><button class="btn btn-primary">Edit</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
