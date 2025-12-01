@extends('admin.layout.base')

@section('title', 'Deposit History')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Deposit History</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Amount ($)</th>
                        <th>ScreenShot</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposit as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}}</td>
                        <td>
                            <a target="_blank" href="{{ url('/storage/'.$value->proof) }}">{{$value->proof}}</a>
                        </td>
                        <td>{{$value->status}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
