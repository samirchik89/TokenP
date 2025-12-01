@extends('admin.layout.base')

@section('title', 'Documents ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">

            <div class="box box-block bg-white">

                <h5 class="mb-1">@lang('admin.documents')</h5>
                <a href="{{ route('admin.tokendocument.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.add_doc')</a>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.doc_name')</th>
                            <th>@lang('admin.order')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('user.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $index => $document)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$document->document_name}}</td>
                            <td>{{$document->order}}</td>
                            <td>@if($document->status==0) <span style="color: red;">Inactive</span> @else  <span style="color: green;">Active</span> @endif</td>
                            <td>
                                <form action="{{ route('admin.tokendocument.destroy', $document->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode') == 0)
                                    <a href="{{ route('admin.tokendocument.edit', $document->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>@lang('admin.delete')</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
