@extends('admin.layout.base')

@section('title', 'Worth Status')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">

            <div class="box box-block bg-white">

                <h5 class="mb-1">Worth Status</h5>

                <a href="{{ route('admin.createworthstatus') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>Worth Status</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($worthstatus as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $value->worth_status }}</td>
                                <td>@if($value->status == 1)
                                        <button class="btn btn-success" type="button">Active</button>
                                    @else
                                        <button class="btn btn-danger" type="button">In-active</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.editworthstatus', $value->id) }}"><button class="btn btn-primary">Edit</button></a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
