@extends($layout)

@section('content')
    <div class="page-content">
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Plaid account</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Connect Bank Account') }}</div>

                        <div class="card-body">
                            <div id="link-result" class="alert" style="display: none;"></div>

                            <div class="mb-3">
                                <p>
                                    Connect your bank account securely using Plaid to access your financial data.
                                </p>

                                <form id="plaid-connect-form" class="mb-3">
                                    <div class="form-group mb-3">
                                        <label for="plaid-title">Title</label>
                                        <input type="text" class="form-control" id="plaid-title" name="title" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="plaid-description">Description</label>
                                        <textarea class="form-control" id="plaid-description" name="description" rows="3"></textarea>
                                    </div>
                                    <button type="submit" id="link-bank-button" class="btn btn-primary">
                                        <i class="fas fa-university me-2"></i>
                                        Connect Bank Account
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Plaid Link Script -->
    <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Cache DOM elements
            const elements = {
                linkButton: $('#link-bank-button'),
                linkResult: $('#link-result'),
                connectedAccounts: $('#connected-accounts'),
                accountsList: $('#accounts-list')
            };

            // Helper functions
            const showResult = (message, type = 'success') => {
                elements.linkResult
                    .removeClass()
                    .addClass(`alert alert-${type}`)
                    .text(message)
                    .show()
                    .delay(5000)
                    .fadeOut();
            };

            const makeApiRequest = (url, options = {}) => {
                const defaultOptions = {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    }
                };

                return $.ajax({
                    url: url,
                    ...defaultOptions,
                    ...options,
                    headers: {
                        ...defaultOptions.headers,
                        ...(options.headers || {})
                    }
                });
            };

            // Plaid Link handlers
            const handlePlaidSuccess = (public_token, metadata) => {
                console.log('Link success:', metadata);

                makeApiRequest('/plaid/exchange-token', {
                        method: 'POST',
                        data: JSON.stringify({
                            public_token,
                            institution_id: metadata.institution.institution_id,
                            fetch_accounts: true,
                            title: $('#plaid-title').val(),
                            description: $('#plaid-description').val()
                        })
                    })
                    .then(data => {
                        if (data.success) {
                            showResult('Bank account connected successfully!', 'success');
                            setTimeout(() => {
                                window.location.href = '/plaid/index';
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Failed to connect bank account');
                        }
                    })
                    .catch(error => {
                        console.error('Exchange token error:', error);
                        showResult('Failed to connect bank account: ' + error.message, 'danger');
                    });
            };

            const handlePlaidExit = (err, metadata) => {
                if (err != null) {
                    console.error('Link exit with error:', err);
                    showResult('Connection cancelled or failed', 'warning');
                }
                updateLinkButtonState(false);
            };

            const updateLinkButtonState = (loading = false) => {
                elements.linkButton
                    .prop('disabled', loading)
                    .html(
                        `<i class="fas fa-university"></i> ${loading ? 'Loading...' : 'Connect Bank Account'}`);
            };

            // Initialize Plaid Link
            const initializePlaidLink = (e) => {
                e.preventDefault();
                updateLinkButtonState(true);

                makeApiRequest('/plaid/create-link-token', {
                        method: 'POST',
                    })
                    .then(data => {
                        if (data.error) {
                            throw new Error(data.message || data.error);
                        }

                        const handler = Plaid.create({
                            token: data.link_token,
                            onSuccess: handlePlaidSuccess,
                            onExit: handlePlaidExit,
                            onEvent: (eventName, metadata) => console.log('Link event:', eventName,
                                metadata)
                        });

                        handler.open();
                        updateLinkButtonState(false);
                    })
                    .catch(error => {
                        console.error('Create link token error:', error);
                        showResult('Failed to initialize bank connection: ' + error.message, 'danger');
                        updateLinkButtonState(false);
                    });
            };

            // Event handlers
            $('#plaid-connect-form').on('submit', initializePlaidLink);

        });
    </script>
@endsection
@section('styles')
    <style>
        /* General spacing utilities */
        .me-1 {
            margin-right: 4px !important;
        }

        .me-2 {
            margin-right: 8px !important;
        }

        .mb-2 {
            margin-bottom: 10px !important;
        }

        .mb-3 {
            margin-bottom: 15px !important;
        }

        .mb-4 {
            margin-bottom: 20px !important;
        }

        .ms-3 {
            margin-left: 15px !important;
        }

        /* Card and panel styles */
        .card {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .card-body {
            padding: 15px;
        }

        /* Account card specific styles */
        .account-card {
            transition: all 0.2s ease-in-out;
        }

        .account-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Typography */
        .bank-title {
            font-size: 16px;
            margin: 0 0 10px 0;
            color: #333;
        }

        /* Badge and status styles */
        .badge {
            font-weight: normal;
            padding: 3px 7px;
        }

        .bg-info {
            background-color: #5bc0de !important;
        }

        .bg-secondary {
            background-color: #777 !important;
        }

        .bg-success {
            background-color: #5cb85c !important;
        }

        .bg-warning {
            background-color: #f0ad4e !important;
        }

        /* Button styles */
        .btn-outline-primary {
            color: #428bca;
            background-color: transparent;
            border-color: #428bca;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #428bca;
            border-color: #428bca;
        }

        .btn-outline-danger {
            color: #d9534f;
            background-color: transparent;
            border-color: #d9534f;
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #d9534f;
            border-color: #d9534f;
        }

        /* Account details */
        .account-details {
            margin-top: 10px;
        }

        .account-type .badge {
            margin-right: 5px;
        }

        .account-meta {
            margin-top: 8px;
            font-size: 12px;
            color: #777;
        }

        .account-meta small {
            margin-right: 15px;
        }

        /* Alert styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert-warning {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
        }

        /* Action buttons */
        .action-buttons {
            margin-top: 10px;
        }

        .action-buttons .btn {
            margin-left: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .col-sm-5.text-end {
                text-align: left;
                margin-top: 10px;
            }

            .action-buttons {
                margin-top: 15px;
            }

            .action-buttons .btn {
                margin: 5px 5px 5px 0;
            }
        }
    </style>
@endsection
