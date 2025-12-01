@extends('issuer.layout.base')
@section('content')
<div class="content-page-inner">
    <div class="header-breadcrumbs">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6">
                            <div class="breadcrumb-four" style="text-align: right;">
                                <ul class="breadcrumb">
                                    <li><a href="{{ url('issuer/dashboard') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                            </path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                    <span>@lang('user.dashboard')</span></a></li>

                                    <li><a href="{{ url('issuer/payments/settings') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                            </path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                    <span>Bank Accounts</span></a></li>

                                    <li class="active"><a href="javscript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2"
                                                ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                        </svg>
                                    <span>Add Bank</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="container-fluid">
        <!-- Top Alert for Backend Responses -->
        @if (session('success'))
            <div id="formAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div id="formAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div id="addBankForm" style="border: 1px solid black; padding: 20px;">
            <form method="POST" action="{{ route('issuer.addBankAccount') }}" id="bankFormUnified">
                @csrf
                <h1 class="mb-4">Add Bank Details</h1>

                <div class="row">
                    <!-- Bank Name -->
                    <div class="form-group col-md-6">
                        <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control">
                        <small class="text-danger" id="bankNameError"></small>
                    </div>

                    <!-- Location -->
                    <div class="form-group col-md-6">
                        <label for="bank_location">Location <span class="text-danger">*</span></label>
                        <input type="text" name="bank_location" id="bank_location" class="form-control">
                        <small class="text-danger" id="locationError"></small>
                    </div>

                    <!-- Address -->
                    <div class="form-group col-md-6">
                        <label for="bank_address">Address <span class="text-danger">*</span></label>
                        <input type="text" name="bank_address" id="bank_address" class="form-control">
                        <small class="text-danger" id="addressError"></small>
                    </div>

                    <!-- Account Name -->
                    <div class="form-group col-md-6">
                        <label for="bank_account_name">Account Name <span class="text-danger">*</span></label>
                        <input type="text" name="bank_account_name" id="bank_account_name" class="form-control">
                        <small class="text-danger" id="accountNameError"></small>
                    </div>

                    <!-- Routing Details -->
                    <div class="form-group col-md-6">
                        <label for="routing_details">Routing Details <span class="text-danger">*</span></label>
                        <input type="text" name="routing_details" id="routing_details" class="form-control">
                        <small class="text-danger" id="routingError"></small>
                    </div>

                    <!-- Beneficiary Name -->
                    <div class="form-group col-md-6">
                        <label for="beneficiary_name">Beneficiary Name <span class="text-danger">*</span></label>
                        <input type="text" name="beneficiary_name" id="beneficiary_name" class="form-control">
                        <small class="text-danger" id="beneficiaryError"></small>
                    </div>

                    <!-- Routing Details -->
                    <div class="form-group col-md-6">
                        <label for="user_contract_id">Select Asset <span class="text-danger">*</span></label>
                        <select name="user_contract_id" id="user_contract_id" class="form-control">
                            <option value="">-- Select Property --</option>
                            @foreach($contracts as $contract)
                                <option value="{{ $contract->id }}">
                                    {{ $contract->property->propertyName }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="assetError"></small>
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-5 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Add Account</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
     const fields = [
        { id: 'bank_name', errorId: 'bankNameError' },
        { id: 'bank_location', errorId: 'locationError' },
        { id: 'bank_address', errorId: 'addressError' },
        { id: 'bank_account_name', errorId: 'accountNameError' },
        { id: 'routing_details', errorId: 'routingError' },
        { id: 'beneficiary_name', errorId: 'beneficiaryError' },
        { id: 'user_contract_id', errorId: 'assetError' },


    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        const error = document.getElementById(field.errorId);

        input.addEventListener('input', () => {
            if (input.value.trim() !== '') {
                error.innerText = '';
            }
        });
    });
    document.getElementById('bankFormUnified').addEventListener('submit', function(event) {
        // Clear previous errors
        document.getElementById('bankNameError').innerText = '';
        document.getElementById('locationError').innerText = '';
        document.getElementById('addressError').innerText = '';
        document.getElementById('accountNameError').innerText = '';
        document.getElementById('routingError').innerText = '';
        document.getElementById('beneficiaryError').innerText = '';
        document.getElementById('assetError').innerText = '';


        let isValid = true;

        const bankName = document.getElementById('bank_name').value.trim();
        const location = document.getElementById('bank_location').value.trim();
        const address = document.getElementById('bank_address').value.trim();
        const accountName = document.getElementById('bank_account_name').value.trim();
        const routingDetails = document.getElementById('routing_details').value.trim();
        const beneficiaryName = document.getElementById('beneficiary_name').value.trim();
        const assetId = document.getElementById('user_contract_id').value.trim();


        if (bankName === '') {
            document.getElementById('bankNameError').innerText = 'Bank name is required';
            isValid = false;
        }
        if (location === '') {
            document.getElementById('locationError').innerText = 'Location is required';
            isValid = false;
        }
        if (address === '') {
            document.getElementById('addressError').innerText = 'Address is required';
            isValid = false;
        }
        if (accountName === '') {
            document.getElementById('accountNameError').innerText = 'Account name is required';
            isValid = false;
        }
        if (routingDetails === '') {
            document.getElementById('routingError').innerText = 'Routing details are required';
            isValid = false;
        }
        if (beneficiaryName === '') {
            document.getElementById('beneficiaryError').innerText = 'Beneficiary name is required';
            isValid = false;
        }

        if (assetId === '') {
            document.getElementById('assetError').innerText = 'Asset selection is required';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Stop form submission if validation fails
        }
    });
</script>




@endsection
