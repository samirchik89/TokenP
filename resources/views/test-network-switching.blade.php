@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Network Switching Test</h4>
                </div>
                <div class="card-body">
                    <p>This page tests the network switching functionality. Connect your MetaMask wallet and try switching between different networks.</p>

                    <div class="alert alert-info">
                        <strong>Instructions:</strong>
                        <ol>
                            <li>Connect your MetaMask wallet</li>
                            <li>Select a crypto option that requires a different network</li>
                            <li>Use the "Switch Network" button to change networks</li>
                            <li>Verify that the network validation works correctly</li>
                        </ol>
                    </div>

                    <!-- Debug Button -->
                    <div class="form-group">
                        <button type="button" id="debug-network-configs" class="btn btn-warning">
                            <i class="fa fa-bug"></i> Debug Network Configs
                        </button>
                        <small class="form-text text-muted">Click this button to check what network configurations are available in the database.</small>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method" class="form-control">
                            <option value="">Select Payment Method</option>
                            <option value="crypto_transfer">Crypto Transfer</option>
                        </select>
                    </div>

                    <!-- Crypto Selector -->
                    <div class="form-group" id="crypto_selector_group" style="display: none;">
                        <label for="crypto_selector">Select Crypto</label>
                        <select id="crypto_selector" class="form-control">
                            <option value="">Select a crypto</option>
                            <option value="1" data-crypto='{"stablecoin":{"title":"USDC","token_address":"0xCA12DDD5595af78777673F673E5D9dB6732Fc23E","decimals":18},"blockchain":{"blockchain_name":"Ethereum","chain_id":11155111,"link":"https://sepolia.etherscan.io/"},"address":"0x1234567890123456789012345678901234567890"}'>USDC on Sepolia</option>
                            <option value="2" data-crypto='{"stablecoin":{"title":"USDT","token_address":"0x70E3A2bd47f690328015A49E66747431B74C4e1f","decimals":18},"blockchain":{"blockchain_name":"Polygon","chain_id":80001,"link":"https://mumbai.polygonscan.com/"},"address":"0x0987654321098765432109876543210987654321"}'>USDT on Mumbai</option>
                        </select>
                    </div>

                    <!-- Include the MetaMask transfer component -->
                    @include('crypto.transfer-metamask')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/ethers.umd.min.js') }}"></script>
<script src="{{ asset('js/crypto/transfer.js') }}"></script>
<script>
$(document).ready(function() {
    console.log('Test network switching page loaded');

    // Show/hide crypto selector based on payment method
    $('#payment_method').on('change', function() {
        console.log('Payment method changed to:', $(this).val());
        if ($(this).val() === 'crypto_transfer') {
            $('#crypto_selector_group').show();
            console.log('Crypto selector shown');
        } else {
            $('#crypto_selector_group').hide();
            console.log('Crypto selector hidden');
        }
    });

    // Debug crypto selector changes
    $('#crypto_selector').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const cryptoData = selectedOption.data('crypto');
        console.log('Crypto selector changed:', {
            value: $(this).val(),
            cryptoData: cryptoData,
            chainId: cryptoData?.blockchain?.chain_id
        });
    });

    // Test network configs endpoint
    $('#debug-network-configs').on('click', function() {
        fetch('/debug-network-configs')
            .then(response => response.json())
            .then(data => {
                console.log('Debug network configs:', data);
                alert('Check console for debug info');
            })
            .catch(error => {
                console.error('Error fetching debug configs:', error);
            });
    });
});
</script>
@endsection