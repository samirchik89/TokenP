{{-- MetaMask Connection Component --}}
<div class="crypto-transfer-container d-none">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info" role="alert" style="font-size: 1.05em;">
                <i class="fa fa-info-circle"></i>
                To make stablecoin payment you have two options. Pay directly using your crypto wallet like MetaMask or Core and as soon as payment is confirmed on blockchain you will receive asset tokens in your custody. This is the fastest way to purchase and receive tokens.<br>
                Second option is you make stablecoin payment separately (please take details of issuer wallet address and total amount for this buy request) and then send a request to issuer with transaction proof including transaction hash and screenshot of transfer. Issuer will verify transfer on blockchain and approve and you will receive tokens in your custody.
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel" style="border: 1px solid #ccc; border-radius: 4px;"  id="crypto_transfer_div">
                <div class="panel-heading" style="padding: 10px 15px; background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                    <h5 class="mb-0" style="margin: 0; font-size: 16px;">
                        Option 1 - Pay with your crypto wallet now and receive asset tokens now
                    </h5>
                </div>

                <div class="panel-body">
                    {{-- Connection Status --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="connection-status" class="control-label">
                                    <i class="fa fa-circle text-danger" id="connection-status-icon"></i>
                                    Connection Status
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="connection-status"
                                       value="Not Connected"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="connected-account" class="control-label">
                                    <i class="fa fa-user"></i> Connected Account
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="connected-account"
                                       value="No account connected"
                                       readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Connection Actions --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" role="group">
                                <button type="button"
                                        class="btn btn-primary"
                                        id="connect-metamask">
                                    <i class="fa fa-wallet"></i> Connect MetaMask
                                </button>
                                <button type="button"
                                        class="btn btn-default"
                                        id="disconnect-metamask"
                                        style="display: none;">
                                    <i class="fa fa-times"></i> Disconnect
                                </button>
                                <button type="button"
                                        class="btn btn-success"
                                        id="get-test-token"
                                        style="display: none;">
                                    <i class="fa fa-gift"></i> Get Test Token
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Test Token Response --}}
                    <div class="row" id="test-token-response" style="display: none;">
                        <div class="col-md-12">
                            <div class="alert" id="test-token-alert" role="alert">
                                <span id="test-token-message"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Test ETH Information --}}
                    @if(config('app.is_demo'))
                    <div class="row" id="test-eth-info">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-info-circle me-2"></i>
                                    <strong>Need test ETH?</strong>
                                </div>
                                <div class="mt-2">
                                    <p class="mb-2">Get your test SepoliaETH here:</p>
                                    <a href="https://cloud.google.com/application/web3/faucet/ethereum/sepolia"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-outline-info btn-sm">
                                        <i class="fa fa-external-link"></i> Google Cloud Sepolia Faucet
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Network Information --}}
                    <div class="row" id="network-info" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="network-name" class="control-label">
                                    <i class="fa fa-globe"></i> Network
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="network-name"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="chain-id" class="control-label">
                                    <i class="fa fa-link"></i> Chain ID
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="chain-id"
                                       readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Network Validation and Switching --}}
                    <div class="row" id="network-validation" style="display: none;">
                        <div class="col-md-12">
                            <div class="alert" id="network-alert" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-exclamation-triangle me-2" id="network-alert-icon"></i>
                                    <span id="network-alert-message"></span>
                                </div>
                                <div class="mt-2" id="network-actions" style="display: none;">
                                    <button type="button" class="btn btn-primary btn-sm" id="switch-network">
                                        <i class="fa fa-exchange-alt"></i> Switch Network
                                    </button>
                                    <button type="button" class="btn btn-info btn-sm" id="add-network">
                                        <i class="fa fa-plus"></i> Add Network
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Account Balance --}}
                    <div class="row" id="balance-info" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eth-balance" class="control-label">
                                    <i class="fa fa-coins"></i> ETH Balance
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="eth-balance"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="token-balance" class="control-label">
                                    <i class="fa fa-token"></i> Token Balance
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="token-balance"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row d-none" id="transaction-actions">
                        <div class="col-md-12">
                            <button type="button"
                                    class="btn btn-success btn-lg"
                                    id="send-start-transaction">
                                <i class="fa fa-paper-plane"></i> Send Transaction
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Instructions Panel --}}
        <div class="col-lg-4 d-none">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-info-circle"></i> Transfer Information
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info">
                        <h6><i class="fa fa-info-circle"></i> Instructions</h6>
                        <ol class="mb-0">
                            <li>Connect your MetaMask wallet first</li>
                            <li>Ensure you have sufficient ETH for gas fees</li>
                            <li>Choose a token from the available options below</li>
                            <li>Click the "Pay with [TOKEN]" button to make a payment</li>
                            <li>Review the transaction details before confirming</li>
                        </ol>
                    </div>

                    {{-- Security Notice --}}
                    <div class="alert alert-warning">
                        <h6><i class="fa fa-shield-alt"></i> Security Notice</h6>
                        <ul class="mb-0">
                            <li>Never share your private keys</li>
                            <li>Verify transaction details before confirming</li>
                            <li>Ensure you're on the correct network</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaction Status Section --}}
    <div class="row" id="transaction-status" style="display: none;">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-exchange-alt"></i> Transaction Status
                    </h4>
                </div>
                <div class="panel-body">
                    {{-- Transaction Details --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transaction-hash" class="control-label">
                                    <i class="fa fa-hashtag"></i> Transaction Hash
                                </label>
                                <div class="input-group">
                                    <input type="text"
                                           class="form-control"
                                           id="transaction-hash"
                                           readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default"
                                                type="button"
                                                id="copy-hash"
                                                title="Copy transaction hash">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transaction-status-text" class="control-label">
                                    <i class="fa fa-info-circle"></i> Status
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="transaction-status-text"
                                       readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress" id="transaction-progress" style="display: none;">
                                <div class="progress-bar progress-bar-striped active"
                                     role="progressbar"
                                     style="width: 0%">
                                    Processing...
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" role="group">
                                <a href="#"
                                   class="btn btn-primary"
                                   id="view-on-etherscan"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   style="display: none;">
                                    <i class="fa fa-external-link"></i> View on Explorer
                                </a>
                                <button type="button"
                                        class="btn btn-info"
                                        id="refresh-status"
                                        style="display: none;">
                                    <i class="fa fa-refresh"></i> Refresh Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loading-overlay" class="loading-overlay" style="display: none;">
    <div class="loading-content">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p class="mt-2" id="loading-message">Processing...</p>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.crypto-transfer-container {
    margin-bottom: 2rem;
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loading-content {
    background-color: white;
    padding: 2rem;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-group {
    margin-bottom: 0.5rem;
}

.panel-title i {
    margin-right: 0.5rem;
}

.alert ul, .alert ol {
    margin-bottom: 0;
}

.progress {
    margin-bottom: 1rem;
}

#transaction-status .panel-body {
    padding: 1.5rem;
}

/* Network Validation Styles */
#network-validation .alert {
    border-radius: 8px;
    border-left: 4px solid;
}

#network-validation .alert-warning {
    border-left-color: #ffc107;
    background-color: #fff3cd;
    color: #856404;
}

#network-validation .alert-danger {
    border-left-color: #dc3545;
    background-color: #f8d7da;
    color: #721c24;
}

#network-actions {
    margin-top: 0.75rem;
}

#network-actions .btn {
    margin-right: 0.5rem;
    margin-bottom: 0.25rem;
}

#network-alert-icon {
    font-size: 1.1em;
}

#network-alert-message {
    font-weight: 500;
}

@media (max-width: 768px) {
    .btn-group {
        display: flex;
        flex-direction: column;
    }

    .btn-group .btn {
        margin-bottom: 0.5rem;
    }

    #network-actions .btn {
        display: block;
        width: 100%;
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}
</style>

