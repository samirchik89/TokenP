@extends('admin.layout.base')

@section('title', 'User Token')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">User Token</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Token</th>
                        <th>Current Holding</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($user_token as $index => $token)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $token->user->name }}</td>
                        <td>{{ $token->usercontract->tokenname }} ({{ $token->usercontract->tokensymbol }})</td>
                        <td>{{$token->token_acquire}}</td>
                        <td>
                            <a href="{{ url('admin/get_whitelist_details', [$token->id, $token->user_id]) }}" class="btn btn-info btn-block"><i class="fa fa-list"></i> View Details</a>
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
