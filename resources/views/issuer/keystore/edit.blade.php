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

    <!-- Main Content -->
    <div class="container-fluid ">
        @if (session('success'))
            <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close close-alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('keystore') }}" class="btn btn-secondary mb-3">← Back</a>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Edit Keystore Title</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('keystore.update', ['id' => $keystore->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="title">Enter New Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $keystore->title) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
</div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeButtons = document.querySelectorAll('.close-alert');

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const alert = this.closest('.alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            });
        });
    });
</script>


</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const msg = document.getElementById('successMessage');
        if (msg) {
            setTimeout(() => {
                msg.style.display = 'none';
            }, 4000); // 4 seconds
        }
    });
</script>
@endsection
