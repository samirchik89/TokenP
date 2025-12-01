@extends('admin.layout.base')

@section('title', 'Deposit Request')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Deposit Request</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Amount ($)</th>
                        <th>Receiver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}}</td>
                        <td>
                            <?php $details = json_decode($value->receiver); ?>
                            Bank Name : {{$details[2]}},<br>
                            Account : {{$details[0]}},<br>
                            {{-- IFSC Code : {{$details[1]}} --}}
                        </td>
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
