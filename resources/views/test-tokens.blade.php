<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Token Request</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mb-0">🚀 Request Test Tokens</h3>
                <p class="mb-0">Get 2000 test tokens sent to your wallet address</p>
            </div>
            <div class="card-body p-4">
                <form id="testTokenForm">
                    <div class="mb-3">
                        <label for="wallet_address" class="form-label">Wallet Address</label>
                        <input type="text" class="form-control" id="wallet_address" name="wallet_address"
                               placeholder="Enter your wallet address (0x...)" required>
                        <div class="form-text">Enter the wallet address where you want to receive test tokens</div>
                    </div>

                    <div class="mb-3">
                        <label for="blockchain_id" class="form-label">Blockchain Network</label>
                        <select class="form-control" id="blockchain_id" name="blockchain_id" required>
                            <option value="">Select a blockchain</option>
                            @foreach(\App\BlockchainModel::get() as $blockchain)
                                <option value="{{ $blockchain->id }}">{{ $blockchain->name }} ({{ $blockchain->abbreviation }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span id="btnText">Request Test Tokens</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2" style="display: none;"></span>
                        </button>
                    </div>
                </form>

                <div id="result" class="mt-3" style="display: none;">
                    <div class="alert" id="alertBox">
                        <div id="resultMessage"></div>
                    </div>
                </div>

                <div class="mt-4">
                    <h6>📋 How it works:</h6>
                    <ul class="list-unstyled">
                        <li>✅ Enter your wallet address and select blockchain</li>
                        <li>✅ Click "Request Test Tokens"</li>
                        <li>✅ 2000 test tokens will be sent automatically</li>
                        <li>✅ You can only request once per wallet address</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('testTokenForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const result = document.getElementById('result');
            const alertBox = document.getElementById('alertBox');
            const resultMessage = document.getElementById('resultMessage');

            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Sending Tokens...';
            btnSpinner.style.display = 'inline-block';
            result.style.display = 'none';

            const formData = {
                wallet_address: document.getElementById('wallet_address').value,
                blockchain_id: document.getElementById('blockchain_id').value,
                _token: '{{ csrf_token() }}'
            };

            fetch('/test-tokens/request', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = 'Request Test Tokens';
                btnSpinner.style.display = 'none';

                // Show result
                result.style.display = 'block';

                if (data.status === 'success') {
                    alertBox.className = 'alert alert-success';
                    resultMessage.innerHTML = `
                        <strong>🎉 Success!</strong><br>
                        ${data.message}<br>
                        ${data.transaction_hash ? `<strong>Transaction Hash:</strong> ${data.transaction_hash}` : ''}
                    `;
                } else {
                    alertBox.className = 'alert alert-danger';
                    resultMessage.innerHTML = `<strong>❌ Error:</strong> ${data.message}`;
                }
            })
            .catch(error => {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = 'Request Test Tokens';
                btnSpinner.style.display = 'none';

                // Show error
                result.style.display = 'block';
                alertBox.className = 'alert alert-danger';
                resultMessage.innerHTML = `<strong>❌ Error:</strong> Network error occurred. Please try again.`;

                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>