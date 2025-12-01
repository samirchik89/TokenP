@extends('admin.layout.base')

@section('title', 'Mailgun Test')

@section('styles')
<style>
    .mailgun-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    textarea {
        height: 100px;
        resize: vertical;
    }
    .btn-mailgun {
        background-color: #007bff;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
    }
    .btn-mailgun:hover {
        background-color: #0056b3;
    }
    .btn-quick-test {
        background-color: #28a745;
    }
    .btn-quick-test:hover {
        background-color: #1e7e34;
    }
    .result {
        margin-top: 20px;
        padding: 15px;
        border-radius: 4px;
        display: none;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .info {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
</style>
@endsection

@section('content')
<div class="mailgun-container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Mailgun Test</h1>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="to_email">To Email:</label>
                <input type="email" id="to_email" name="to_email" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" placeholder="Enter email subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
            </div>

            <button class="btn-mailgun" onclick="sendTestEmail()">Send Test Email</button>
            <button class="btn-mailgun btn-quick-test" onclick="quickTest()">Quick Test</button>

            <div id="result" class="result"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function sendTestEmail() {
        const toEmail = document.getElementById('to_email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        if (!toEmail || !subject || !message) {
            showResult('Please fill in all fields', 'error');
            return;
        }

        showResult('Sending email...', 'info');

        fetch('{{ route('admin.mailgun.send-test-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': Laravel.csrfToken
            },
            body: JSON.stringify({
                to_email: toEmail,
                subject: subject,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showResult(data.message, 'success');
            } else {
                showResult(data.message, 'error');
            }
        })
        .catch(error => {
            showResult('Error: ' + error.message, 'error');
        });
    }

    function quickTest() {
        showResult('Sending quick test email...', 'info');

        fetch('{{ route('admin.mailgun.quick-test') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': Laravel.csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showResult(data.message, 'success');
            } else {
                showResult(data.message, 'error');
            }
        })
        .catch(error => {
            showResult('Error: ' + error.message, 'error');
        });
    }

    function showResult(message, type) {
        const resultDiv = document.getElementById('result');
        resultDiv.textContent = message;
        resultDiv.className = 'result ' + type;
        resultDiv.style.display = 'block';
    }
</script>
@endsection