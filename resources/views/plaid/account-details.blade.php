@extends($layout)

@section('content')
    <!-- Bootstrap 4.1 + 3.7 Compatible Layout -->
    <div class="container-fluid py-4">
        <!-- Header Section - Bootstrap 3.7 & 4.1 -->
        <div class="bg-light py-3 mb-4 panel panel-default">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-0 page-header">{{ $plaidItem->title }} ({{$plaidItem->institution->name}}) Connected bank accounts</h1>
                    </div>
                    <div class="col-sm-6">
                        <div id="link-result" class="alert" style="display: none;"></div>
                        <!-- Button Group - Bootstrap 3.7 & 4.1 Compatible -->
                        <div class="float-right pull-right">
                            <a href="{{ route('plaid.index') }}" class="btn btn-secondary btn-default mr-2" style="margin-right: 10px;">
                                <i class="fas fa-arrow-left glyphicon glyphicon-arrow-left"></i> Back
                            </a>
                            <a data-id="{{ $plaidItem->id }}" class="plaid-link-id btn btn-primary">
                                <i class="fas fa-university glyphicon glyphicon-link"></i> Link accounts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mb-4">
                @forelse($plaidItemAccounts as $plaidItemAccount)
                    <!-- Account Summary Card - Bootstrap 3.7 & 4.1 -->
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card panel panel-default h-100 shadow-sm">
                            <!-- Card Header - Bootstrap 3.7 & 4.1 -->
                            <div class="card-header panel-heading bg-light">
                                <h5 class="card-title panel-title mb-0">{{ $plaidItemAccount->name }}</h5>
                            </div>
                            <!-- Card Body - Bootstrap 3.7 & 4.1 -->
                            <div class="card-body panel-body">
                                <div id="account-summary-{{ $plaidItemAccount->id }}">
                                    <div class="d-flex justify-content-between align-items-start mb-4 clearfix">
                                        <div class="pull-left">
                                            @if ($plaidItemAccount->official_name)
                                                <p class="text-muted mb-2 small">{{ $plaidItemAccount->official_name }}</p>
                                            @endif
                                            <!-- Bootstrap 3.7 & 4.1 Badge -->
                                            <span class="badge badge-{{ $plaidItemAccount->status === 'active' ? 'success' : 'secondary' }} label label-{{ $plaidItemAccount->status === 'active' ? 'success' : 'default' }}">
                                                {{ ucfirst($plaidItemAccount->status) }}
                                            </span>
                                        </div>
                                        <div class="text-right pull-right">
                                            @if ($plaidItemAccount->mask)
                                                <div class="mb-2">
                                                    <span class="text-muted small">Account ending in</span>
                                                    <span class="badge badge-light label label-default font-weight-bold">{{ $plaidItemAccount->mask }}</span>
                                                </div>
                                            @endif
                                            <div>
                                                <span class="badge badge-info label label-info">{{ ucfirst($plaidItemAccount->type) }}</span>
                                                @if ($plaidItemAccount->subtype)
                                                    <span class="badge badge-info label label-info">{{ ucfirst($plaidItemAccount->subtype) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if ($accountBalances->has($plaidItemAccount->account_id))
                                            <div class="col-6 col-xs-6">
                                                <!-- Bootstrap 3.7 Well + Bootstrap 4.1 Card -->
                                                <div class="card bg-light border-0 well well-sm">
                                                    <div class="card-body p-3">
                                                        <p class="text-muted mb-1 small">Current Balance</p>
                                                        <h4 class="mb-0 text-dark">
                                                            ${{ number_format($accountBalances->get($plaidItemAccount->account_id)['balances']['current'], 2) }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-xs-6">
                                                <!-- Bootstrap 3.7 Well + Bootstrap 4.1 Card -->
                                                <div class="card bg-light border-0 well well-sm">
                                                    <div class="card-body p-3">
                                                        <p class="text-muted mb-1 small">Available Balance</p>
                                                        <h4 class="mb-0 text-dark">
                                                            ${{ number_format($accountBalances->get($plaidItemAccount->account_id)['balances']['available'] ?? 0, 2) }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 col-md-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle glyphicon glyphicon-info-sign"></i> No accounts found. Please connect an account first.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="row mb-4">
                <!-- Transactions Card - Bootstrap 3.7 & 4.1 -->
                <div class="col-12 col-md-12">
                    <div class="card panel panel-default shadow-sm">
                        <!-- Card Header - Bootstrap 3.7 & 4.1 -->
                        <div class="card-header panel-heading bg-light">
                            <div class="d-flex justify-content-between align-items-center clearfix">
                                <h5 class="card-title panel-title mb-0 pull-left">
                                    <i class="fas fa-exchange-alt glyphicon glyphicon-transfer"></i> Recent Transactions
                                </h5>
                            </div>
                        </div>
                        <!-- Card Body - Bootstrap 3.7 & 4.1 -->
                        <div class="card-body panel-body p-0">
                            <div id="transactions-list-{{ $plaidItemAccount->id }}">
                                @forelse($transactions['transactions'] as $transaction)
                                    <!-- Transaction Item - Bootstrap 3.7 & 4.1 -->
                                    <div class="border-bottom p-3 list-group-item">
                                        <div class="d-flex justify-content-between align-items-start clearfix">
                                            <div class="flex-grow-1 pull-left" style="width: 70%;">
                                                <h6 class="mb-1 font-weight-bold list-group-item-heading">{{ $transaction['name'] }}</h6>
                                                <p class="mb-1 text-muted small list-group-item-text">
                                                    <i class="fas fa-calendar-alt glyphicon glyphicon-calendar"></i>
                                                    {{ \Carbon\Carbon::parse($transaction['date'])->format('M d, Y') }}
                                                </p>
                                                @if(isset($transaction['category']) && !empty($transaction['category']))
                                                    <div class="mb-0">
                                                        @foreach($transaction['category'] as $category)
                                                            <!-- Bootstrap 3.7 & 4.1 Badge/Label -->
                                                            <span class="badge badge-light label label-default small">{{ $category }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-right pull-right ml-3" style="width: 25%;">
                                                <!-- Amount with Bootstrap 3.7 & 4.1 Colors -->
                                                <h5 class="mb-0 font-weight-bold {{ $transaction['amount'] > 0 ? 'text-danger' : 'text-success' }}">
                                                    {{ $transaction['amount'] > 0 ? '-' : '+' }}${{ number_format(abs($transaction['amount']), 2) }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center p-5">
                                        <i class="fas fa-receipt fa-3x text-muted mb-3 glyphicon glyphicon-file" style="font-size: 3em;"></i>
                                        <p class="text-muted">No transactions found for this period.</p>
                                    </div>
                                @endforelse

                                @if (isset($transactions['total_pages']) && $transactions['total_pages'] > 1)
                                    <!-- Pagination - Bootstrap 3.7 & 4.1 Compatible -->
                                    <div class="d-flex justify-content-center p-3 text-center">
                                        <nav aria-label="Transaction navigation">
                                            <ul class="pagination mb-0">
                                                @for ($i = 1; $i <= $transactions['total_pages']; $i++)
                                                    <li class="page-item {{ $transactions['current_page'] == $i ? 'active' : '' }}">
                                                        <a class="page-link" href="?account={{ $plaidItemAccount->id }}&page={{ $i }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </nav>
                                    </div>
                                @endif
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
                linkButton: $('.plaid-link-id'),
                linkResult: $('#link-result'),
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
                            item_id: $('.plaid-link-id').data('id')
                        })
                    })
                    .then(data => {
                        if (data.success) {
                            showResult('Bank account connected successfully!', 'success');
                            setTimeout(() => {
                                window.location.reload();
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
                        `<i class="fas fa-university glyphicon glyphicon-link"></i> ${loading ? 'Loading...' : 'Link accounts'}`);
            };

            // Initialize Plaid Link
            const initializePlaidLink = (e) => {
                e.preventDefault();
                updateLinkButtonState(true);

                makeApiRequest('/plaid/create-link-token', {
                        method: 'POST',
                        data: JSON.stringify({
                            item_id: elements.linkButton.data('id')
                        })
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
            elements.linkButton.on('click', initializePlaidLink);

        });
    </script>
@endsection
