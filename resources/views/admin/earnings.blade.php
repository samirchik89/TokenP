@extends('admin.layout.base')

@section('title', 'Earnings ')

@section('content')
    <div class="content-area py-1">
        <div style="margin-top:2%; margin-left:1%; margin-bottom:1%">
            <h3>Total Earnings (All Property) : $ {{$total_earnings}}</h3>
        </div>
        <div class="container-fluid">
            <div class="box box-block bg-white">
            <table class="table table-striped table-bordered dataTable user-list-table" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Token Name</th>
                        <th>Interest (%)</th>
                        <th>Actual Amount</th>
                        <th>Issuer Amount</th>
                        <th>Earning</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($earnings as $index => $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($value->created_at)) }}</td>
                            <td>{{ $value->user->name }}</td>
                            <td>{{ $value->user_contract->tokenname }}</td>
                            <td>
                                <?php
                                    $property = App\Property::where('id',$value->user_contract->property_id)->first();
                                    \Log::info($property);
                                    $interest = $property->interest == NULL ? Setting::get('admin_commission') : $property->interest;
                                ?>
                                {{$interest}}
                            </td>
                            <td>{{ $value->trx_amount + $value->earning }}</td>
                            <td>{{ $value->trx_amount }}</td>
                            <td>{{ $value->earning }}</td>
                            <td>{{ $value->payment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
