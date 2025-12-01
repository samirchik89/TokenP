@extends('issuer.layout.base')
@section('content')
<div class="content-page-inner">
    <div class="header-breadcrumbs">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>Manage Keystore</h1>
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
                                    <span>Manage Keystore</span></a></li>
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

        <a href="{{ route('keystore') }}" class="btn btn-secondary mb-3">← Back</a>

        <div id="keystoreForm" style="border: 1px solid black; padding: 20px;">
            <form method="POST" action="{{ route('keystore.create') }}" id="keystoreFormUnified">
                @csrf
                <h1 class="mb-4">Add a Keystore</h1>
                <p class="mb-4">
                    You can either upload your own private key or let the platform generate one for you.
                    In both cases, you’ll need to provide a title and a password to secure the keystore.
                </p>

                <!-- Title -->
                <div class="form-group">
                    <label>Title for this private key <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control">
                    <small class="text-danger" id="titleError"></small>
                </div>

                <!-- Password (Single) -->
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" id="password" class="form-control" minlength="6" required>
                    <small class="text-danger" id="passwordError"></small>
                </div>


                <input type="hidden" name="method" id="method">
                <input type="hidden" name="password" id="manualPassword">
                <input type="hidden" name="generate_password" id="generatePassword">

                <!-- Method 1 -->
                <h2>Method 1 : Save your own Private key</h2>
                <p>You can save your own private key as encrypted keystore file on the platform,
                    please use your own crypto wallet like MetaMask to generate your private key
                </p>
                <div class="m1">
                    <div class="form-group">
                        <label>Private Key <span class="text-danger">*</span></label>
                        <input type="text" name="private_key" id="private_key" class="form-control">
                        <small class="text-danger" id="privateKeyError"></small>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="submitKeystoreForm('manual')">Create</button>
                    </div>
                </div>

                <!-- Method 2 -->
                <div class="m2 mt-5">
                    <h2>Method 2 : Let platform generate private key</h2>
                    <p>Just enter title and password, click generate, and the platform will display your private key—
                        be sure to save both the private key and password.
                    </p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="submitKeystoreForm('generate')">Generate</button>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>

<script>
    function validateTitle() {
        const title = document.getElementById('title').value.trim();
        const errorEl = document.getElementById('titleError');
        if (!title) {
            errorEl.textContent = "Title is required.";
            return false;
        } else {
            errorEl.textContent = "";
            return true;
        }
    }

    function validatePrivateKey() {
        const privateKey = document.getElementById('private_key').value.trim();
        const errorEl = document.getElementById('privateKeyError');
        if (!privateKey) {
            errorEl.textContent = "Private Key is required.";
            return false;
        } else {
            errorEl.textContent = "";
            return true;
        }
    }

    function validatePassword() {
        const password = document.getElementById('password').value.trim();
        const errorEl = document.getElementById('passwordError');

        if (!password) {
            errorEl.textContent = "Password is required.";
            return false;
        } else if (password.length < 6) {
            errorEl.textContent = "Password must be at least 6 characters long.";
            return false;
        } else {
            errorEl.textContent = "";
            return true;
        }
    }


    // Input validation on change
    document.getElementById('title').addEventListener('input', validateTitle);
    document.getElementById('private_key').addEventListener('input', validatePrivateKey);
    document.getElementById('password').addEventListener('input', validatePassword);

    function clearErrors() {
        document.querySelectorAll('small.text-danger').forEach(el => el.textContent = '');
        const formAlert = document.getElementById('formAlert');
        if (formAlert) formAlert.classList.add('d-none');
    }

    function submitKeystoreForm(method) {
        clearErrors();
        const titleValid = validateTitle();
        const passwordValid = validatePassword();

        let isValid = titleValid && passwordValid;
        const passwordValue = document.getElementById('password').value.trim();

        if (method === 'manual') {
            const privateKeyValid = validatePrivateKey();
            isValid = isValid && privateKeyValid;

            // Set correct field values
            document.getElementById('manualPassword').value = passwordValue;
            document.getElementById('generatePassword').value = '';
        } else if (method === 'generate') {
            // Set correct field values
            document.getElementById('generatePassword').value = passwordValue;
            document.getElementById('manualPassword').value = '';
        }

        if (!isValid) return;

        document.getElementById('method').value = method;
        document.getElementById('keystoreFormUnified').submit();
    }
</script>




@endsection
