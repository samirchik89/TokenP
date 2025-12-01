@extends('admin.layout.base')

@section('title', 'User Token')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Whitelist details</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Token</th>
                        <th>Token Acquire (EW)</th>
                        <th>Wallet</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($get_whitelist as $index => $token)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $token->user->name }}</td>
                        <?php
                            $contract = App\UserContract::where('id', $token->user_contract)->first();
                        ?>
                        <td>{{ $contract->tokenname }} ({{ $contract->tokensymbol }})</td>
                        <td>{{$token->amount}}</td>
                        <td>{{$token->address}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var url = "{{ url('/') }}";
            $(".status-btn").click(function(){
                $.ajax({
                    type    :   "POST",
                    url     :   url+'/admin/token/status',
                    data    :   "_token={{ csrf_token() }}&value="+$(this).data("value")+"&id="+$(this).data("id"),
                    success :   function(data)
                    {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection
