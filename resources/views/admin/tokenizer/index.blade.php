@extends('admin.layout.base')

@section('title', 'Tokens ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <a href="{{ route('admin.tokenizer') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Token</a>
            <table class="table table-striped table-bordered dataTable" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>Token Name</th>
                        <th>Token Symbol</th>
                        <th>Token Value</th>
                        <th>Token Supply</th>
                        <th>Contract Address</th>
                        <th>Token Bonus</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $index => $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $value->tokenname }}</td>
                            <td>{{ $value->tokensymbol }}</td>
                            <td>{{ $value->tokenvalue }}</td>
                            <td>{{ $value->tokensupply }}</td>
                            <td>{{ $value->contract_address }}</td>
                            <td>{{ $value->bonus }}</td>
                            <td> <a href="{{route('admin.tokenizeredit',$value->id)}}" class="btn btn-info"> Edit </a> </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
