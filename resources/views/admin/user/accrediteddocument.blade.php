@extends('admin.layout.base')

@section('title', 'User Accredited Documents')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

        <div class="box box-block bg-white">
            <h5 class="mb-1">User KYC Documents</h5>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('admin.doc_type')</th>
                        <th>Front Side</th>
                        <th>Back Side</th>
                        <th>Download</th>
                        <th>@lang('admin.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($Doc as $Index => $Document)

                    <tr>
                        <td>{{ $Index + 1 }}</td>
                        <td>@if($Document->document){{ $Document->document->name }}@endif</td>
                        <td><a href="{{ img($Document->url) }}" target="_blank">view</a></td>
                        <td><a href="{{ img($Document->back_url) }}" target="_blank">view</a></td>
                        <td><a href="{{ Storage::url($Document->url)}}" target="_blank" download>Download Front Side</a><br><br>
                            <a href="{{ Storage::url($Document->back_url)}}" target="_blank" download>Download Back Side</a>
                        </td>
                        <td>{{ $Document->status}}</td>
                        <td>
                            @if($Document->status=="PENDING")
                            <div class="col-xs-6">
                            <form action="{{ route('admin.useraccrediteddocument.approve')}}" method="POST">
                                {{ csrf_field() }}

                                <input type="hidden" name="status" value="APPROVED">
                                <input type="hidden" name="user_id" value="{{$Document->user->id}}">
                                <input type="hidden" name="doc_id" value="{{$Document->accredited_document_id}}">
                                <button class="btn btn-success" type="submit">Approve</button>
                            </form>
                            </div>
                             <div class="col-xs-6">
                                <form action="{{ route('admin.useraccrediteddocument.approve')}}" method="POST">
                                {{ csrf_field() }}

                                <input type="hidden" name="status" value="REJECTED">
                                <input type="hidden" name="user_id" value="{{$Document->user->id}}">
                                <input type="hidden" name="doc_id" value="{{$Document->accredited_document_id}}">
                                <button class="btn btn-danger" type="submit">Reject</button>
                            </form>
                            </div>
                            @elseif($Document->status=="REJECTED")
                            <div class="col-xs-6">
                                <form action="{{ route('admin.useraccrediteddocument.approve')}}" method="POST">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="status" value="APPROVED">
                                    <input type="hidden" name="user_id" value="{{$Document->user->id}}">
                                    <input type="hidden" name="doc_id" value="{{$Document->accredited_document_id}}">
                                    <button class="btn btn-success" type="submit">Approve</button>
                                </form>
                                </div>

                            @elseif($Document->status=="APPROVED")

                            <div class="col-xs-6">
                                <form action="{{ route('admin.useraccrediteddocument.approve')}}" method="POST">
                                {{ csrf_field() }}

                                <input type="hidden" name="status" value="REJECTED">
                                <input type="hidden" name="user_id" value="{{$Document->user->id}}">
                                <input type="hidden" name="doc_id" value="{{$Document->accredited_document_id}}">
                                <button class="btn btn-danger" type="submit">Reject</button>
                            </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</div>




@endsection
