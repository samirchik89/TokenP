@extends('admin.layout.base')

@section('title', 'Coins ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <!-- <a href="{{ route('admin.coin.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Coin</a> -->
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                       <th>Id</th>
                        <th>Coin Name</th>
                        <th>Coin Symbol</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Coin as $index => $coin)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $coin->coin_name }}</td>
                        <td>{{ $coin->symbol }}</td>
                        <td>
                            @if($coin->status == '1')
                            <a class="btn btn-danger btn-block" href="{{ route('admin.coin.disableStatus', $coin->id ) }}">@lang('Disable')</a>
                            @else
                            <a class="btn btn-success btn-block" href="{{ route('admin.coin.enableStatus', $coin->id ) }}">@lang('Enable')</a>
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
