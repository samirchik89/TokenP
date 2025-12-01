@extends('admin.layout.base')

@section('title', 'User Wallets')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            <h5 class="mb-1">User Wallets</h5>
            <select class="form-control" name="type" id="walletType" style="width:150px;">
                <option value="{{ url('/admin/user_wallet', 'investor') }}"
                    {{ request()->segment(3) === 'investor' ? 'selected' : '' }}>
                    Investor
                </option>
                <option value="{{ url('/admin/user_wallet', 'issuer') }}"
                    {{ request()->segment(3) === 'issuer' ? 'selected' : '' }}>
                    Issuer
                </option>
            </select>
            <br>
            <table class="table table-striped table-bordered dataTable user-list-table" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>USD Balance</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($users as $index => $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->USD }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#walletType').on('change', function() {
            const selectedValue = $(this).val();
            if (selectedValue) {
                window.location.href = selectedValue; // Redirect to the selected URL
            }
        });
    });
</script>
