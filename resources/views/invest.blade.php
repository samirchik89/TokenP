@extends('layout.app')

@section('content')
@php
    // try {
        // Initialize default values
        $currentStep = 1;
        $contractAddress = $contract->contract_address;
        $selectedWallet = 'internal';
        $tokenType = $property->token_type;
        $enableInternalWallet = $property->enable_internal_wallet !== 0;

        // Initialize purchase request object
        $purchaseRequest = (object) [
            'tokens' => 0,
            'total_amount' => 0,
            'payment_method' => 'Bank Transfer',
            'id' => 1
        ];

        $savedPaymentDetails = [];

        // Handle existing user token data
        if (!empty($userToken)) {
            $currentStep = ($userToken->current_stage + 1) ?? 1;

            if ($currentStep >= 1) {
                $selectedWallet = $userToken->wallet_type;
                $totalDealSize = $userToken->commission + $userToken->deal_amount;
                $requestedTokens = $userToken->token_acquire;
                $purchaseRequest->tokens = $userToken->token_acquire;
                $wallet_id = $userToken->wallet_id;

                // Load saved payment details for completed stages
                if ($currentStep > 3 && !empty($paymentConfigs)) {
                    $savedPaymentDetails = [];

                    if ($userToken->payment_mode == 'bank_transfer') {
                        $bank = $paymentConfigs['bank_transfer']['config'][$userToken->payment_mode_id];
                        $savedPaymentDetails = [
                            'bank_name' => $bank['bank_name'],
                            'bank_location' => $bank['bank_location'],
                            'bank_account_name' => $bank['bank_account_name'],
                            'beneficiary_name' => $bank['beneficiary_name'],
                            'bank_address' => $bank['bank_address'],
                            'routing_details' => $bank['routing_details'],
                        ];
                    } elseif ($userToken->payment_mode == 'crypto_transfer') {
                        // dd($paymentConfigs,$userToken);
                        $crypto = $paymentConfigs['crypto_transfer']['config'][$userToken->payment_mode_id];
                        $url = $crypto['blockchain']['link'] . 'token/' . $crypto['stablecoin']['token_address'];

                        $savedPaymentDetails = [
                            'stablecoin' => $crypto['stablecoin']['title'],
                            'blockchain' => $crypto['blockchain']['blockchain_name'],
                            'address' => $crypto['address'],
                            'chain_id' => $crypto['blockchain']['chain_id'],
                            'stable_address' => $crypto['stablecoin']['token_address'],
                            'decimal' => $crypto['stablecoin']['decimals'],
                            'stable_address_html' => '<a href="' . e($url) . '" target="_blank" rel="noopener noreferrer">' .
                                e($crypto['stablecoin']['title'] . ': ' . $crypto['stablecoin']['token_address']) . '</a>'
                        ];
                    }

                    $savedPaymentDetails['paymentReference'] = $userToken->payment_reference_id;
                    $savedPaymentDetails['url'] = $userToken->payment_proof_url;
                }
            }
        }

        // Prepare user and issuer data
        $user_id = $user->id;
        $issuer = (object) [
            'name' => $issuerDetails->identity
                ? $issuerDetails->identity->first_name . ' ' . $issuerDetails->identity->last_name
                : $issuerDetails->name,
            'address' => $issuerDetails->identity
                ? $issuerDetails->identity->address_line_1
                : $issuerDetails->address
        ];

        // Prepare property data
        $property = (object) [
            'id' => $property->id,
            'name' => $property->propertyName,
            'address' => $property->propertyLocation,
            'total_tokens' => $contract->tokensupply,
            'available_tokens' => $contract->tokenbalance,
            'token_price' => $contract->tokenvalue,
            'initialInvestment' => $property->initialInvestment
        ];

        // Set investment constraints
        $minTokens = min($property->initialInvestment ?? 1, $property->available_tokens);
        $custodySet = true;
        $paymentStatus = 'ready';

        // Initialize payment selection variables
        $selectedBankIndex = null;
        $selectedCryptoIndex = 0;
        $selectedCrypto = 0;

    // } catch (\Exception $e) {
    //     dd($e->getLine(), $e->getMessage());
    // }
@endphp
{{-- Consolidated Stylesheet --}}
<style>
    /* ===== STAGE MANAGEMENT ===== */
    .stage-content {
        padding: 1.5rem;
        transition: all 0.4s ease;
        transform-origin: top;
    }

    .stage-content.collapsing {
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.4s ease, opacity 0.3s ease;
    }

    .stage-content.collapsed {
        max-height: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        opacity: 0;
        overflow: hidden;
    }

    .stage-toggle-icon {
        font-size: 16px;
        transition: transform 0.3s ease;
        cursor: pointer;
        color: inherit;
        margin-left: 10px;
    }

    .stage-toggle-icon.rotated {
        transform: rotate(180deg);
    }

    .stage-header-content {
        display: flex;
        align-items: center;
    }

    .stage-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
        border-radius: 8px 8px 0 0;
        position: relative;
        overflow: visible;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stage-header.active {
        background-color: #007bff;
        color: white;
    }

    .stage-header.completed {
        background-color: #28a745;
        color: white;
    }

    .stage-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .stage-card.active {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .stage-card.completed {
        border-color: #28a745;
        background-color: #f8fff9;
    }

    /* ===== PROGRESS INDICATOR ===== */
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .step {
        flex: 1;
        text-align: center;
        position: relative;
    }

    .step::after {
        content: '';
        position: absolute;
        top: 15px;
        left: 50%;
        width: 100%;
        height: 2px;
        background-color: #dee2e6;
        z-index: -1;
    }

    .step:last-child::after {
        display: none;
    }

    .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #dee2e6;
        color: #6c757d;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .step.active .step-circle {
        background-color: #007bff;
        color: white;
    }

    .step.completed .step-circle {
        background-color: #28a745;
        color: white;
    }

    .step.completed::after {
        background-color: #28a745;
    }

    /* ===== DETAIL ROWS ===== */
    .detail-row {
        margin-bottom: 0.75rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #495057;
    }

    .detail-value {
        color: #212529;
    }

    /* ===== WALLET OPTIONS ===== */
    .wallet-option {
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .wallet-option:hover {
        border-color: #007bff;
    }

    .wallet-option.selected {
        border-color: #007bff;
        background-color: #f8f9ff;
    }

    .section-wallet-input {
        display: flex;
        flex-direction: row;
    }

    /* ===== PAYMENT STATUS ===== */
    .payment-status {
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 1rem;
        font-size: 15px;
    }

    .payment-status svg {
        margin-right: 8px;
        flex-shrink: 0;
    }

    .payment-status-text {
        display: flex;
        align-items: center;
        line-height: 1.5;
    }

    .payment-status form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .send-payment-btn {
        display: inline-flex !important;
        align-items: center;
        gap: 6px;
    }

    /* ===== UTILITY CLASSES ===== */
    .d-none {
        display: none;
    }

    .section-title {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .section-desc {
        color: #6c757d;
        line-height: 1.6;
    }

    .w-30 {
        width: 30%;
    }

    .w-50 {
        width: 50%;
    }

    .m-5 {
        margin: 5px;
    }

    /* ===== TOOLTIP ===== */
    .custom-tooltip {
        position: absolute;
        bottom: 100%;
        left: var(--mouse-x, 50%);
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
        z-index: 1000;
        margin-bottom: 5px;
        pointer-events: none;
    }

    .custom-tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: var(--arrow-x, 50%);
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: #333;
    }

    .tooltip-wrapper:hover .custom-tooltip {
        opacity: 1;
        visibility: visible;
    }
</style>

<div class="content-page-inner">
<!-- Breadcrumb -->
    <div class="header-breadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h1>Invest</h1></div>
                <div class="col-sm-6">
                    @include('issuer.layout.breadcrumb',['items'=>[
                        ['title'=>'Home','url'=>url('/dashboard')],
                        ['title'=>'Offerings','url'=>url('/propertyList')],
                        ['title'=>$property->name,'url'=>url('propertyDetail/'.$property->id)],
                        ['title'=>'Invest'],
                    ]])

                </div>
            </div>
        </div>
    </div>


    @if(empty($paymentConfigs))
        <div class="alert alert-info" role="alert" style="background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb;">
            Issuer has not yet specified any payment option. Please contact issuer for more details to purchase tokens from this property/asset
        </div>
    @endif

    @if($property->available_tokens <= 0)
        <div class="alert alert-warning" role="alert" style="background-color: #fff3cd; color: #856404; border-color: #ffeaa7;">
            <i class="fa fa-exclamation-triangle"></i>
            No tokens are currently available for purchase. Please check back later or contact the issuer for more information.
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="content">
                    <div class="container-fluid p-0">
                        <h5 class="section-title">Buy Request for {{ $property->name }}</h5>
                        <p class="section-desc">
                            Complete the following steps to purchase property tokens. Ensure all details are correct before proceeding with your purchase. This process involves three stages: reviewing purchase details, setting up token custody, and completing payment to the issuer.
                        </p>

                        <!-- Progress Indicator -->
                        <div class="step-indicator">
                            <div class="step {{ $currentStep > 1 ? 'completed' : ($currentStep == 1 ? 'active' : '') }}">
                                <div class="step-circle">
                                    @if($currentStep > 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @else
                                        1
                                    @endif
                                </div>
                                <div class="step-label">Details</div>
                            </div>
                            <div class="step {{ $currentStep > 2 ? 'completed' : ($currentStep == 2 ? 'active' : '') }}">
                                <div class="step-circle">
                                    @if($currentStep > 2)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @else
                                        2
                                    @endif
                                </div>
                                <div class="step-label">Custody</div>
                            </div>
                            <div class="step {{ $currentStep > 3 ? 'completed' : ($currentStep == 3 ? 'active' : '') }}">
                                <div class="step-circle">
                                    @if($currentStep > 3)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @else
                                        3
                                    @endif
                                </div>
                                <div class="step-label">Payment</div>
                            </div>


                        </div>

                        <!-- Stage 1: Details -->
                        <div id="stage1" class="stage-card {{ $currentStep == 1 ? 'active' : ($currentStep > 3 ? 'completed' : '') }}">
                            <div class="stage-header {{ $currentStep > 1 ? 'completed' : ($currentStep == 1 ? 'active' : '') }}">
                                <div class="stage-header-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         style="margin-right: 8px;">
                                        <path d="m9 12 2 2 4-4"></path>
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span style="font-size: large;">
                                        Stage 1: Purchase Details
                                    </span>
                                </div>
                                <i class="fa-solid fa-chevron-down stage-toggle-icon" onclick="toggleStageContent('stage1')" style="cursor: pointer;"></i>
                            </div>

                            {{-- <div class="stage-content collapsible" id="stage1-content"> --}}
                            <div class="stage-content {{ $currentStep > 1 ? 'collapsed' : '' }}" id="stage1-content">
                                <form method="POST"
                                      action="{{ route('upsertPurchaseRequest', ['user_id' => $user_id, 'id' => $contract->id]) }}"
                                      id="purchaseRequestFormStageOne">
                                    @csrf

                                    <div class="row">
                                        <!-- Issuer Details -->
                                        <div class="col-md-4">
                                            <h6 class="text-primary mb-3">Issuer Details</h6>
                                            <div class="detail-row">
                                                <div class="detail-label">Issuer Name</div>
                                                <div class="detail-value">{{ empty($issuer->name) ? 'N/A' : $issuer->name }}</div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Issuer Address</div>
                                                <div class="detail-value">{{ empty($issuer->address) ? 'N/A' : $issuer->address}}</div>
                                            </div>
                                        </div>

                                        <!-- Property Details -->
                                        <div class="col-md-4">
                                            <h6 class="text-primary mb-3">Property Details</h6>
                                            <div class="detail-row">
                                                <div class="detail-label">Property Name</div>
                                                <div class="detail-value">{{ $property->name }}</div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Property Address</div>
                                                <div class="detail-value">{{ $property->address }}</div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Price per Token</div>
                                                <div class="detail-value text-success">${{ $property->token_price }}</div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Total Tokens</div>
                                                <div class="detail-value">{{ $property->total_tokens }}</div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Total Tokens Available</div>
                                                <div class="detail-value" id="availableTokenSupply">{{ $property->available_tokens }}</div>
                                            </div>
                                        </div>

                                        <!-- Purchase Details -->
                                        <div class="col-md-4">
                                            <h6 class="text-primary mb-3">Purchase Details</h6>
                                            <div class="detail-row">
                                                <div class="detail-label">Minimum Token for investment</div>
                                                <div class="detail-value">
                                                    <span id="min_token_display">{{ $minTokens }} tokens</span>
                                                    <input type="hidden" id="min_token_value" value="{{ $minTokens }}">
                                                    @if($property->available_tokens < $property->initialInvestment)
                                                        <br><small class="text-warning">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                            Note: Available tokens ({{ $property->available_tokens }}) are less than the original minimum investment ({{ $property->initialInvestment }}).
                                                            The minimum investment has been adjusted accordingly.
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="detail-row">
                                                <div class="detail-label">Number of Tokens Requested</div>
                                                <div class="detail-value">
                                                    @if ($currentStep < 4)
                                                        @if($isDemo)
                                                            <input type="number" name="tokens" class="form-control no-of-token"
                                                                id="requested_token_count"
                                                                value="1"
                                                                min="{{ $minTokens }}"
                                                                required
                                                                {{ $property->available_tokens <= 0 ? 'disabled' : '' }}
                                                                oninput="handleTokenInput()"
                                                                readonly
                                                                />
                                                        @else
                                                        <input type="number" name="tokens" class="form-control no-of-token"
                                                               id="requested_token_count"
                                                               value="{{ old('tokens', $purchaseRequest->tokens) }}"
                                                               min="{{ $minTokens }}"
                                                               required
                                                               {{ $property->available_tokens <= 0 ? 'disabled' : '' }}
                                                               oninput="handleTokenInput()"
                                                               />
                                                        @endif
                                                        <small id="token_error" class="text-danger d-none">
                                                            Please enter number of tokens to buy (Minimum token: {{ $property->initialInvestment }})
                                                        </small>
                                                    @else
                                                        <span id="requested_token_count">{{ $requestedTokens }} tokens</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="detail-row">
                                                <div class="detail-label">Price per Token</div>
                                                <div class="detail-value">
                                                    $<span id="token_price_display">{{ number_format($property->token_price, 2) }}</span>
                                                    <input type="hidden" id="token_price" value="{{ $property->token_price }}">
                                                </div>
                                            </div>

                                            <div class="detail-row">
                                                <div class="detail-label">Total Deal Size</div>
                                                <div class="detail-value text-success font-weight-bold">
                                                    $<span id="total_token_value" data-amount="{{ $totalDealSize ?? 0 }}">{{ $totalDealSize ?? 0 }}</span>
                                                </div>
                                            </div>

                                            <!-- Hidden Inputs -->
                                            <input type="hidden" id="contract_id" value="{{ $contract->id }}">
                                            <input type="hidden" id="user_token_id" value="{{ empty($userToken) ? null : $userToken->id }}">
                                            <input type="hidden" id="user_id" value="{{ $user_id }}">
                                            <input type="hidden" id="min_invest" value="{{ $minTokens }}">
                                            <input type="hidden" id="max_invest" value="{{ $property->available_tokens }}">

                                            <input type="hidden" name="payby" id="payby" value="USD">
                                            <input type="hidden" id="bonus_token">
                                            <input type="hidden" id="total_token">
                                            <input type="hidden" id="amount">
                                            <input type="hidden" id="stepOne" name="currentStep" value="1">
                                        </div>
                                    </div>

                                    @if($currentStep != 4)
                                        <!-- Action Button -->
                                        <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end;">
                                            <button type="button" class="btn btn-primary" onclick="goToNextStepTwo()" {{ $property->available_tokens <= 0 ? 'disabled' : '' }}>Save</button>
                                        </div>

                                    @endif
                                </form>
                            </div>
                        </div>


                        <!-- Stage 2: Details -->
                        <div class="stage-card {{ ($currentStep == 2 && $currentStep > 1) ? 'active' : ($currentStep > 3 ? 'completed' : '') }}" id="stage2">
                            <form id="custodyForm" method="POST" action="{{ route('upsertPurchaseRequest', ['user_id' => $user_id, 'id' => $contract->id])}} }}">
                                @csrf
                                <input type="hidden" id ='stepTwo' name="currentStep" value="2">
                                <input type="hidden" id="final_wallet_address" name="contract_address" value="">
                                <div class="stage-header {{ $currentStep == 2 ? 'active' : ($currentStep > 2 ? 'completed' : '') }}">
                                    <div class="stage-header-content">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             style="margin-right: 8px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <circle cx="12" cy="16" r="1"></circle>
                                            <path d="m7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <span style="font-size: large;">
                                            Stage 2: Custody of Tokens
                                        </span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down stage-toggle-icon {{ $currentStep != 2 ? 'rotated' : '' }}" onclick="toggleStageContent('stage2')" style="cursor: pointer;"></i>
                                </div>

                                <div class="stage-content {{ $currentStep != 2 ? 'collapsed' : '' }}" id="stage2-content">
                                     <p class="mb-4">You need to decide whether you want to receive tokens in your internal wallet or external wallet.</p>

                                    <!-- Wallet Options -->
                                        <div class="row">
                                            <div class="col-md-6" style="{{ $enableInternalWallet ? '' : 'display: none;' }}">
                                                <div class="wallet-option {{ $selectedWallet == 'internal' ? 'selected' : '' }} {{ $currentStep < 4 ? 'clickable' : '' }}"

                                                    @if($currentStep < 4 && $currentStep > 1) onclick="selectWallet('internal')" @endif>
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio"
                                                            name="custody"
                                                            id="internal"
                                                            class="form-check-input me-3"
                                                            value="internal"
                                                            {{ $selectedWallet == 'internal' ? 'checked' : '' }}
                                                            {{ $currentStep == 4 ? 'disabled' : '' }}
                                                            onclick="selectWallet('internal')">
                                                        <div>
                                                            <h6 class="mb-1">Internal Wallet</h6>
                                                            <p class="text-muted mb-0 small">Tokens will be stored in your platform wallet for easy management</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="contract_id" value="{{ $contract->id }}">


                                                <input type="hidden" id="payby" value="USD"> {{-- or dynamic --}}
                                                <input type="hidden" id="bonus_token">
                                                <input type="hidden" id="total_token">
                                                <input type="hidden" id="amount">


                                            </div>

                                            <div class="col-md-6">
                                                <div class="wallet-option {{ $selectedWallet == 'external'  ? 'selected' : '' }} {{ $currentStep < 4 ? 'clickable' : '' }}"
                                                    @if($currentStep < 4 && $currentStep > 1) onclick="selectWallet('external')" @endif>
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio"
                                                            name="custody"
                                                            id="external"
                                                            class="form-check-input me-3"
                                                            value="external"
                                                            {{ $selectedWallet == 'external' || $enableInternalWallet == false ? 'checked' : '' }}
                                                            {{ $currentStep == 4 ? 'readonly' : '' }}
                                                        >
                                                        <div>
                                                            <h6 class="mb-1">External Wallet</h6>
                                                            <p class="text-muted mb-0 small">Tokens will be sent to your external blockchain address</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <!-- Internal Wallet Input -->
                                    <div class="mt-4" id="wallet-input-internal" style="display: {{
                                    $enableInternalWallet &&
                                    $selectedWallet == 'internal' ? 'block' : 'none'
                                    }}">
                                        <div class="p-3 bg-light rounded">
                                            <small class="form-text text-muted">Tokens cannot be recovered if set to wrong address.</small>
                                            <input type="text"
                                                id="internal_wallet_address"
                                                class="form-control w-30"
                                                value="{{ $contractAddress }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <!-- External Wallet Input -->
                                    <div class="mt-4" id="wallet-input-external" style="display: {{ $selectedWallet == 'external' || $enableInternalWallet == false ? 'block' : 'none' }}">
                                        <div class="p-3 bg-light rounded">
                                            <small class="form-text text-muted">Tokens cannot be recovered if set to wrong address.</small>
                                            <div class="section-wallet-input ">
                                                @if($tokenType == 3)
                                                    <input type="text"
                                                        name="external_wallet_address"
                                                        id="external_wallet_address"
                                                        class="form-control w-30"
                                                        placeholder="Enter your external wallet address"
                                                        value="{{ $userToken->receiver_wallet_address ?? '' }}"
                                                        {{ $currentStep > 3 ? 'readonly' : '' }}
                                                        required>
                                                @else
                                                    <select id="whitelisted_wallet_id_dropdown"
                                                            name="whitelisted_wallet_id"
                                                            class="form-control w-30"
                                                            {{ $currentStep > 3 ? 'disabled' : '' }}
                                                            onchange="" required>

                                                            <option value="">-- Select Wallet Address --</option>
                                                            @foreach ($whitelistedWallets as $id => $value)
                                                                <option
                                                                    value="{{ $value->id }}"
                                                                    data-id="{{ $value->id }}"
                                                                    {{ (!isset($wallet_id) && $whitelistedWallets->first()->id == $value->id) || (isset($wallet_id) && $wallet_id == $value->id) ? 'selected' : '' }}
                                                                >
                                                                    {{ $value->wallet_address }}
                                                                </option>
                                                        @endforeach

                                                    </select>
                                                    @if($currentStep <= 3)
                                                        <button type="button"
                                                            id='white_list_address_btn'
                                                            class="btn btn-outline-primary m-5"
                                                            onclick='openWalletModal()'>
                                                            Add New Wallet Address
                                                        </button>
                                                    @endif
                                                @endif

                                            </div>
                                            <small id="external-wallet-error" class="text-danger d-none">
                                                Select or add the wallet for external wallet receivable
                                            </small>
                                        </div>
                                    </div>

                                    <div class="modal" id="walletModal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
                                        <div class="modal-dialog" style="margin: 10% auto; max-width: 500px;">
                                            <div class="modal-content border-0">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Wallet Address</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-muted">Please enter a valid wallet address.</p>
                                                    <input type="text" id="new_wallet_address" class="form-control" placeholder="0x..." />
                                                    <small id="walletModalError" class="text-danger d-none mt-2"></small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" onclick="closeWalletModal()">Cancel</button>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="submitNewWallet()">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Action Button -->
                                    @if($currentStep < 4 && $currentStep > 1)
                                    <div class="mt-4 w-100 d-flex justify-content-between"  style="display: flex; justify-content: space-between; width: 100%;">
                                        <button type="button" class="btn btn-secondary" onclick="goToPreviousStep(1)">
                                            <i class="fa-solid fa-arrow-left"></i> Previous Step
                                        </button>
                                        <button type="button" class="btn btn-primary" onclick="setCustody({{$tokenType}})">
                                        <i class="fa-solid fa-wallet"></i> Set Custody
                                        </button>
                                    </div>

                                    @endif
                                </div>
                            </form>
                        </div>


                        <!-- Stage 3: Payment to Issuer -->
                        <div class="stage-card {{ $currentStep == 3 && !empty($paymentConfigs) ? 'active' : ($currentStep > 3 ? 'completed' : '') }}" id="stage3">
                            <div class="stage-header {{ $currentStep == 3 ? 'active' : ($currentStep > 3 ? 'completed' : '') }}">
                                <div class="stage-header-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         style="margin-right: 8px;">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                    <span style="font-size: large;">
                                        Stage 3: Payment to Issuer
                                    </span>
                                </div>
                                <i class="fa-solid fa-chevron-down stage-toggle-icon {{ $currentStep != 3 ? 'rotated' : '' }}" onclick="toggleStageContent('stage3')" style="cursor: pointer;"></i>
                            </div>
                            <div class="stage-content {{ $currentStep != 3 ? 'collapsed' : '' }}" id="stage3-content">
                                <!-- Payment Summary -->
                                <div class="mt-4">
                                    <h6 class="text-primary mb-3">Payment Summary</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-row">
                                                <div class="detail-label">Total Token Amount</div>
                                                <div class="detail-value font-weight-bold text-success">
                                                    ${{ number_format($userToken->deal_amount ?? 0, 2) }}
                                                </div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Payment Method</div>
                                                <div class="detail-value">
                                                    <select name="payment_method" id="payment_method" class="form-control w-50"
                                                        {{ $currentStep < 3 ? 'disabled' : '' }}>
                                                        <option value="">Select Payment Method</option>
                                                        @foreach($paymentConfigs as $key => $method)
                                                            <option value="{{ $key }}"
                                                                {{ !empty($userToken->payment_mode) && $userToken->payment_mode == $key ? 'selected' : '' }}>
                                                                {{ $method['label'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="detail-row">
                                                <div class="detail-label">Transaction Fee</div>
                                                <div class="detail-value">${{ number_format($userToken->commission ?? 0, 2) }}</div>
                                            </div>
                                            <div class="detail-row">
                                                <div class="detail-label">Total Payable</div>
                                                <div class="detail-value font-weight-bold">
                                                    ${{ number_format(($userToken->deal_amount ?? 0) + ($userToken->commission ?? 0), 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($paymentConfigs['bank_transfer']['config']))
                                   <div id="bank_transfer_section" class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title text-info" style="margin: 0;">Bank Transfer Information</h4>
                                        </div>
                                        <div class="panel-body">
                                            {{-- Bank Dropdown --}}
                                            <div class="form-group">
                                                <label for="bank_selector" class="control-label">Select Bank</label>
                                                <select id="bank_selector"
                                                        class="form-control"
                                                        name="bank_selector"
                                                        {{ $currentStep > 3 ? 'disabled' : '' }}>
                                                    <option disabled {{ empty($userToken->payment_reference_id) ? 'selected' : '' }} value="">Select a bank</option>
                                                    @foreach($paymentConfigs['bank_transfer']['config'] as $bank)
                                                        <option value="{{ $bank['id'] }}"
                                                            data-bank='@json($bank)'
                                                            {{ !empty($userToken->payment_mode_id) && $bank['id'] == $userToken->payment_mode_id ? 'selected' : '' }}>
                                                            {{ $bank['bank_name'] }} - {{ $bank['bank_location'] }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if($currentStep > 3)
                                                    <input type="hidden" name="bank_selector" value="{{ $userToken->payment_mode_id }}">
                                                @endif
                                            </div>


                                            {{-- Bank Details Section --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="detail-row">
                                                        <div class="detail-label">Bank Name</div>
                                                        <div class="detail-value" id="bank_name">{{empty($savedPaymentDetails['bank_name']) ? '-' : $savedPaymentDetails['bank_location']}}</div>
                                                    </div>
                                                    <div class="detail-row">
                                                        <div class="detail-label">Bank Location</div>
                                                        <div class="detail-value" id="bank_location">{{empty($savedPaymentDetails['bank_account_name']) ? '-' : $savedPaymentDetails['bank_location']}}</div>
                                                    </div>
                                                    <div class="detail-row">
                                                        <div class="detail-label">Account Type</div>
                                                        <div class="detail-value" id="bank_account_name">{{empty($savedPaymentDetails['beneficiary_name']) ? '-' : $savedPaymentDetails['bank_account_name']}}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="detail-row">
                                                        <div class="detail-label">Beneficiary Name</div>
                                                        <div class="detail-value" id="beneficiary_name">{{empty($savedPaymentDetails['beneficiary_name']) ? '-' : $savedPaymentDetails['beneficiary_name']}}</div>
                                                    </div>
                                                    <div class="detail-row">
                                                        <div class="detail-label">Bank Address</div>
                                                        <div class="detail-value" id="bank_address">{{empty($savedPaymentDetails['bank_address']) ? '-' : $savedPaymentDetails['bank_address']}}</div>
                                                    </div>
                                                    <div class="detail-row">
                                                        <div class="detail-label">Routing Details</div>
                                                        <div class="detail-value" id="routing_details">{{empty($savedPaymentDetails['routing_details']) ? '-' : $savedPaymentDetails['bank_address']}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($paymentConfigs['crypto_transfer']['config']))
                                    <div id="crypto_transfer_section" class="panel panel-info">
                                        <div class="panel-heading ">
                                            <h4 class="panel-title " style="margin: 0;">Crypto Transaction Information</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="crypto_selector" class="control-label">Select Crypto Wallet</label>
                                                <select id="crypto_selector" class="form-control">
                                                    <option disabled selected value="">Select a crypto wallet</option>
                                                    @foreach($paymentConfigs['crypto_transfer']['config'] as $crypto)
                                                    <option value="{{ $crypto['id'] }}" data-crypto='@json($crypto)' {{ (!empty($userToken->payment_mode_id) && $userToken->payment_mode_id == $crypto['id']) ? 'selected' : '' }}>
                                                        {{ $crypto['blockchain']['blockchain_name'] }} :
                                                        {{ $crypto['stablecoin']['title'] }} - {{  $crypto['stablecoin']['token_address'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="alert alert-info" role="alert">
                                                <i class="fa fa-info-circle"></i>
                                                <strong>Important:</strong> To get your tokens in your wallet, you must have Metamask installed. You can see the instructions here: <a href="https://metamask.io/en-GB/download" target="_blank" rel="noopener noreferrer">https://metamask.io/en-GB/download</a>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="detail-row">
                                                        <div class="detail-label">Stablecoin Address</div>
                                                        <div class="detail-value" id="crypto_stablecoin">
                                                            {!! empty($savedPaymentDetails['stable_address_html']) ? '-' : $savedPaymentDetails['stable_address_html'] !!}
                                                        </div>
                                                    </div>
                                                    <div class="detail-row">
                                                        <div class="detail-label">Cryto Chain</div>
                                                        <div class="detail-value" id="crypto_chain">{{ empty($savedPaymentDetails['blockchain']) ? '-' : $savedPaymentDetails['blockchain']  }} </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="detail-row">
                                                        <div class="detail-label">Issuer's Wallet Address</div>
                                                        <div class="detail-value" id="crypto_wallet_address">{{ empty($savedPaymentDetails['address']) ? '-' : $savedPaymentDetails['address']  }} </div>
                                                    </div>
                                                    <div class="detail-row">
                                                        <div class="detail-label">Chain Id</div>
                                                        <div class="detail-value" id="crypto_chain_id">{{ empty($savedPaymentDetails['chain_id']) ? '-' : $savedPaymentDetails['chain_id']  }} </div>
                                                    </div>
                                                    <div class="detail-row d-none">
                                                        <div class="detail-label">Chain Decimal</div>
                                                        <div class="detail-value" id="crypto_chain_decimal">{{ empty($savedPaymentDetails['decimal']) ? '18' : $savedPaymentDetails['decimal']  }} </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    @include('crypto.transfer-metamask')
                                @endif
                                <div class="panel" style="border: 1px solid #ccc; border-radius: 4px;"  id="payment_proof_div">
                                    <div class="panel-heading" style="padding: 10px 15px; background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                                        <h5 class="mb-0 payment-proof-title" style="margin: 0; font-size: 16px;">Payment Proof Upload</h5>
                                    </div>

                                    <div class="panel-body" style="padding: 15px;">
                                        <form method="POST"
                                            action="{{ route('upsertPurchaseRequest', ['user_id' => $user_id, 'id' => $contract->id]) }}"
                                            enctype="multipart/form-data"
                                            id="payment_proof_form"
                                            style="display: none;">
                                            @csrf
                                            <input type="hidden" name="currentStep" value="3">
                                            <input type="hidden" name="payment_method" id="hidden_payment_method">
                                            <input type="hidden" name="selected_payment_id" id="hidden_selected_payment_id">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="paymentReference" class="form-label">Payment Reference</label>
                                                    <input type="text"
                                                           name="payment_reference"
                                                           id="paymentReference"
                                                           class="form-control"
                                                           placeholder="Transaction ID / Hash"
                                                           value="{{ old('payment_reference', $userToken->payment_reference_id ?? '') }}"
                                                           {{ $currentStep > 3 ? 'readonly' : '' }}
                                                           required>
                                                    <small class="form-text text-muted">Transaction ID (Bank) or Hash (Crypto)</small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="paymentProof" class="form-label">Payment Proof</label>

                                                    @if(!empty($userToken->payment_proof_url))
                                                        <div class="mt-2">
                                                            <a href="{{ $userToken->payment_proof_url }}" target="_blank">
                                                                <img src="{{ img($userToken->payment_proof_url) }}" alt="Proof" class="img-thumbnail" style="max-height: 150px;">
                                                            </a>
                                                        </div>
                                                    @else
                                                        <input type="file" name="payment_proof" id="paymentProof" class="form-control" accept="image/*" required>
                                                        <small class="form-text text-muted">Upload screenshot or receipt (Image)</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="payment-status bg-info text-white p-3 mt-3" style="background-color: #0dcaf0; color: white; padding: 1rem; margin-top: 1rem;">
                                                <div class="row" style="margin: 0;">
                                                    @if($currentStep == 3 && $currentStep > 2)
                                                        <div class="col-xs-6" style="padding-top: 6px;">
                                                            <span class="help-block" style="margin: 0; color: #000;">
                                                                After sending the payment, you will not be able to update the purchase request until the issuer reviews it.
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-6" style="text-align: right;">
                                                            <button type="button"
                                                                    class="btn btn-secondary btn-sm me-2"
                                                                    onclick="goToPreviousStep(2)">
                                                                <i class="fa-solid fa-arrow-left"></i> Previous Step
                                                            </button>
                                                            <button type="submit"
                                                                    class="btn btn-success btn-sm send-payment-btn"
                                                                    {{ $currentStep > 3 ? 'disabled' : '' }}>

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                                                    <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                                                                </svg>

                                                                <span>Send Payment</span>
                                                            </button>
                                                        </div>

                                                    @elseif($currentStep == 4)
                                                        <div class="col-xs-12">
                                                            <span class="mb-0">Your Purchase Request is under Review.</span>
                                                        </div>
                                                    @else
                                                        <div class="col-xs-12">
                                                            <span class="mb-0">Complete the previous Steps</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- Action Buttons   -->
                        @if($currentStep > 1 && $currentStep < 4 )
                            <div class="d-flex justify-content-between mt-4">
                                <div class="d-flex gap-2 tooltip-wrapper" style="display:flex;margin-top: 1.5rem; justify-content: space-between; width: 100%;">
                                    @if($currentStep == 3)
                                        <button type="button"
                                                class="btn btn-secondary d-flex align-items-center gap-2"
                                                onclick="goToPreviousStep(2)">
                                            <i class="fa-solid fa-arrow-left"></i> Previous Step
                                        </button>
                                    @endif
                                    <div class="d-flex gap-2 d-none" >
                                        <form method="POST" action="{{ route('discardPurchaseRequest', ['user_id' => $user_id, 'id' => $contract->id]) }}">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-danger d-flex align-items-center gap-2"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Once payment is done the request can't be discarded">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-save">
                                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                                    <polyline points="17 21 17 13 7 13 7 21" />
                                                    <polyline points="7 3 7 8 15 8" />
                                                </svg>
                                                Discard Request
                                            </button>
                                        </form>
                                        <div class="custom-tooltip">The official name of the real-world asset being tokenized.</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<link rel="stylesheet" href="{{ asset('main/vendor/toastr/toastr.min.css') }}" />
<script src="{{ asset('main/vendor/toastr/toastr.min.js') }}" type="application/javascript"></script>
<script src="{{ asset('js/ethers.umd.min.js') }}" type="application/javascript"></script>
<script src="{{ asset('js/crypto/transfer.js') }}?v={{ time() }}" type="application/javascript"></script>

<script>
    // ===== STAGE MANAGEMENT =====

    /**
     * Toggle stage content visibility with smooth animation
     * @param {string} stageId - The ID of the stage to toggle
     */
    function toggleStageContent(stageId) {
        const content = document.getElementById(stageId + '-content');
        const icon = document.querySelector(`#${stageId} .stage-toggle-icon`);

        if (content.classList.contains('collapsed')) {
            expandStageContent(content, icon);
        } else {
            collapseStageContent(content, icon);
        }
    }

    /**
     * Collapse stage content with animation
     * @param {HTMLElement} content - The content element to collapse
     * @param {HTMLElement} icon - The toggle icon element
     */
    function collapseStageContent(content, icon) {
        const height = content.scrollHeight;
        content.style.maxHeight = height + 'px';
        content.classList.add('collapsing');
        content.offsetHeight; // Force reflow
        content.style.maxHeight = '0px';
        icon.classList.add('rotated');

        setTimeout(() => {
            content.classList.add('collapsed');
            content.classList.remove('collapsing');
            content.style.maxHeight = '';
        }, 400);
    }

    /**
     * Expand stage content with animation
     * @param {HTMLElement} content - The content element to expand
     * @param {HTMLElement} icon - The toggle icon element
     */
    function expandStageContent(content, icon) {
        content.classList.remove('collapsed');
        content.classList.add('collapsing');
        const height = content.scrollHeight;
        content.style.maxHeight = height + 'px';
        icon.classList.remove('rotated');

        setTimeout(() => {
            content.classList.remove('collapsing');
            content.style.maxHeight = '';
        }, 400);
    }

    // ===== PAYMENT METHOD HANDLING =====

    /**
     * Initialize payment method selection handlers
     */
    function initializePaymentHandlers() {
        const paymentMethodSelect = document.getElementById('payment_method');
        const bankSelect = document.getElementById('bank_selector');
        const cryptoSelect = document.getElementById('crypto_selector');
        const proofForm = document.getElementById('payment_proof_form');
        const proofFormDiv = document.getElementById('payment_proof_div');
        const hiddenPaymentMethod = document.getElementById('hidden_payment_method');
        const hiddenPaymentId = document.getElementById('hidden_selected_payment_id');

        function resetHiddenInputs() {
            hiddenPaymentMethod.value = '';
            hiddenPaymentId.value = '';
            proofForm.style.display = 'none';
            proofFormDiv.style.display = 'none';
        }

        function updateFormData() {
            const method = paymentMethodSelect?.value;
            let selectedId = null;

            if (method === 'bank_transfer' && bankSelect?.value) {
                selectedId = bankSelect.value;
            }

            if (method === 'crypto_transfer' && cryptoSelect?.value) {
                selectedId = cryptoSelect.value;
            }

            hiddenPaymentMethod.value = method || '';
            hiddenPaymentId.value = selectedId || '';

            proofForm.style.display = (method && selectedId) ? 'block' : 'none';
            proofFormDiv.style.display = (method && selectedId) ? 'block' : 'none';

            if (method === 'crypto_transfer') {
                $('.payment-proof-title').text('Option 2 - Manually make blockchain transaction and send request to issuer');
            } else {
                $('.payment-proof-title').text('Payment Proof Upload');
            }
        }

        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', () => {
                resetHiddenInputs();
                updateFormData();
            });
        }

        if (bankSelect) bankSelect.addEventListener('change', updateFormData);
        if (cryptoSelect) cryptoSelect.addEventListener('change', updateFormData);

        updateFormData(); // Initial check on load
    }

    // ===== BANK SELECTOR HANDLING =====

    /**
     * Initialize bank selector change handler
     */
    function initializeBankSelector() {
        const bankSelector = document.getElementById('bank_selector');
        if (bankSelector) {
            bankSelector.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const bankData = JSON.parse(selectedOption.dataset.bank);

                document.getElementById('bank_address').innerText = bankData.bank_address;
                document.getElementById('bank_location').innerText = bankData.bank_location || '';
                document.getElementById('routing_details').innerText = bankData.routing_details || '';
                document.getElementById('bank_name').innerText = bankData.bank_name || '';
                document.getElementById('beneficiary_name').innerText = bankData.beneficiary_name || '';
                document.getElementById('bank_account_name').innerText = bankData.bank_account_name || '';
                document.getElementById('bank_details').style.display = 'block';
            });
        }
    }

    // ===== CRYPTO SELECTOR HANDLING =====

    /**
     * Initialize crypto selector change handler
     */
    function initializeCryptoSelector() {
        const cryptoSelector = document.getElementById('crypto_selector');
        if (cryptoSelector) {
            cryptoSelector.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const cryptoData = JSON.parse(selectedOption.dataset.crypto);
                const link = cryptoData.blockchain.link + 'token/' + cryptoData.stablecoin.token_address;

                const linkHtml = `<a href="${link || '#'}" target="_blank" rel="noopener noreferrer">
                    ${cryptoData?.stablecoin?.title || ''}: ${cryptoData?.stablecoin?.token_address || ''}
                </a>`;

                document.getElementById('crypto_stablecoin').innerHTML = linkHtml;
                document.getElementById('crypto_wallet_address').innerText = cryptoData.address || '';
                document.getElementById('crypto_chain').innerText = cryptoData.blockchain.blockchain_name || '';
                document.getElementById('crypto_chain_id').innerText = cryptoData.blockchain.chain_id || '';
                document.getElementById('crypto_chain_decimal').innerText = cryptoData.stablecoin.decimals || '18';
            });
        }
    }

    // ===== PAYMENT SECTIONS TOGGLE =====

    /**
     * Initialize payment sections visibility toggle
     */
    function initializePaymentSections() {
        const paymentMethodSelect = document.getElementById('payment_method');
        const sections = {
            bank_transfer: document.getElementById('bank_transfer_section'),
            crypto_transfer: document.getElementById('crypto_transfer_section')
        };

        function toggleSections() {
            const selected = paymentMethodSelect.value;

            Object.entries(sections).forEach(([key, el]) => {
                if (el) {
                    el.style.display = (key === selected) ? 'block' : 'none';
                }
            });
        }

        if (paymentMethodSelect) {
            toggleSections(); // Initial toggle
            paymentMethodSelect.addEventListener('change', toggleSections);
        }
    }

    // ===== WALLET MODAL HANDLING =====

    /**
     * Open wallet modal for adding new addresses
     */
    function openWalletModal() {
        document.getElementById('walletModal').style.display = 'block';
        document.getElementById('walletModalError').classList.add('d-none');
        document.getElementById('new_wallet_address').value = '';
    }

    /**
     * Close wallet modal
     */
    function closeWalletModal() {
        document.getElementById('walletModal').style.display = 'none';
    }

    /**
     * Submit new wallet address for whitelisting
     */
    function submitNewWallet() {
        const address = document.getElementById('new_wallet_address').value.trim();
        const errorText = document.getElementById('walletModalError');
        const contract_id = document.getElementById('contract_id').value;
        const user_token_id = document.getElementById('user_token_id').value;
        const user_id = document.getElementById('user_id').value;

        if (!address || !/^0x[a-fA-F0-9]{40}$/.test(address)) {
            errorText.textContent = "Invalid wallet address.";
            errorText.classList.remove('d-none');
            return;
        }

        // Disable modal actions while processing
        errorText.classList.remove('d-none');
        errorText.classList.remove('text-danger');
        errorText.classList.add('text-info');
        errorText.textContent = "Whitelisting address...";

        $.ajax({
            url: `/${user_id}/whitelistAddress/${contract_id}?token_id=${user_token_id}`,
            type: "POST",
            data: {
                address: address,
                _token: '{{ csrf_token() }}'
            },
            success: function(results) {
                if (results.status) {
                    errorText.textContent = results.message || "Wallet address added successfully.";
                    errorText.classList.remove('text-danger');
                    errorText.classList.add('text-success');

                    if (results.code == 201) {
                        // Use updated wallet list to re-render dropdown
                        const select = document.getElementById('whitelisted_wallet_id_dropdown');
                        select.innerHTML = '<option value="">-- Select Wallet Address --</option>';
                        const wallets = results.data;

                        wallets.forEach(wallet => {
                            const option = document.createElement('option');
                            option.value = wallet.id;
                            option.setAttribute('data-id', wallet.id);
                            option.textContent = wallet.wallet_address;

                            // Select the newly added one (case-insensitive match)
                            if (wallet.wallet_address.toLowerCase() === address.toLowerCase()) {
                                option.selected = true;
                            }

                            select.appendChild(option);
                        });
                    }
                    setTimeout(closeWalletModal, 1500);
                } else {
                    errorText.textContent = results.message || "Failed to whitelist address.";
                    errorText.classList.remove('text-success');
                    errorText.classList.add('text-danger');
                }
            },
            error: function() {
                errorText.textContent = "Something went wrong while whitelisting.";
                errorText.classList.remove('text-success');
                errorText.classList.add('text-danger');
            }
        });
    }

    // ===== WALLET SELECTION =====

    /**
     * Select wallet type (internal or external)
     * @param {string} type - The wallet type to select
     */
    function selectWallet(type) {
        const internalDiv = document.querySelector("#internal").closest(".wallet-option");
        const externalDiv = document.querySelector("#external").closest(".wallet-option");

        if (type === 'internal') {
            document.getElementById('internal').checked = true;
            document.getElementById('wallet-input-internal').style.display = 'block';
            document.getElementById('wallet-input-external').style.display = 'none';
            internalDiv.classList.add('selected');
            externalDiv.classList.remove('selected');
        } else {
            document.getElementById('external').checked = true;
            document.getElementById('wallet-input-internal').style.display = 'none';
            document.getElementById('wallet-input-external').style.display = 'block';
            externalDiv.classList.add('selected');
            internalDiv.classList.remove('selected');
        }
    }

    // ===== CUSTODY SETUP =====

    /**
     * Set custody configuration and submit form
     * @param {number} tokenType - The type of token being purchased
     * @returns {boolean} - Whether the operation was successful
     */
    function setCustody(tokenType) {
        const selectedWallet = document.querySelector('input[name="custody"]:checked')?.value;
        const finalCustodyWallet = document.getElementById('final_wallet_address');
        const externalWalletError = document.getElementById('external-wallet-error');

        if (selectedWallet === 'internal') {
            finalCustodyWallet.value = document.getElementById('internal_wallet_address').value;
        } else if (selectedWallet === 'external') {
            if (tokenType === 3) {
                const externalAddressInput = document.getElementById('external_wallet_address');
                const externalVal = externalAddressInput.value.trim();

                if (!externalVal) {
                    externalWalletError.textContent = "Please enter your external wallet address.";
                    externalWalletError.classList.remove('d-none');
                    return false;
                }

                finalCustodyWallet.value = externalVal;
            } else {
                const externalDropdown = document.getElementById('whitelisted_wallet_id_dropdown');
                const externalVal = externalDropdown.value;

                if (!externalVal) {
                    externalWalletError.textContent = "Please select a whitelisted external wallet address.";
                    externalWalletError.classList.remove('d-none');
                    return false;
                }

                finalCustodyWallet.value = externalVal;
            }
        } else {
            alert("Please select a wallet option.");
            return false;
        }

        document.getElementById('custodyForm').submit();
        return true;
    }

    // ===== FORM VALIDATION =====

    /**
     * Validate and submit stage one form
     */
    function goToNextStepTwo() {
        const tokenInput = document.getElementById('requested_token_count');
        const errorText = document.getElementById('token_error');
        const minInvest = parseInt(document.getElementById('min_invest').value);
        const maxInvest = parseInt(document.getElementById('max_invest').value);

        if (!tokenInput.value ||
            parseInt(tokenInput.value) <= 0 ||
            parseInt(tokenInput.value) < minInvest ||
            parseInt(tokenInput.value) > maxInvest) {
            errorText.classList.remove('d-none');
            errorText.textContent = `Please enter a valid number of tokens (${minInvest} to ${maxInvest})`;
            tokenInput.focus();
        } else {
            errorText.classList.add('d-none');
            document.getElementById('purchaseRequestFormStageOne').submit();
        }
    }

    // ===== NAVIGATION FUNCTIONS =====

    /**
     * Navigate to a previous step
     * @param {number} targetStep - The step number to navigate to
     */
    function goToPreviousStep(targetStep) {
        // Get current form data
        const contract_id = document.getElementById('contract_id').value;
        const user_id = document.getElementById('user_id').value;

        console.log('Navigating to step:', targetStep);

        // Create a simple form to submit just the step change
        const newForm = document.createElement('form');
        newForm.method = 'POST';
        newForm.action = "{{ route('updateInvestmentStep', ['user_id' => ':user_id', 'id' => ':contract_id']) }}"
            .replace(':user_id', user_id)
            .replace(':contract_id', contract_id);

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        newForm.appendChild(csrfToken);

        // Add only the current step
        const currentStepInput = document.createElement('input');
        currentStepInput.type = 'hidden';
        currentStepInput.name = 'currentStep';
        currentStepInput.value = targetStep;
        newForm.appendChild(currentStepInput);

        // Add to document and submit
        document.body.appendChild(newForm);

        // Submit the form and then refresh the page
        newForm.addEventListener('submit', function() {
            setTimeout(function() {
                window.location.reload();
            }, 100);
        });

        newForm.submit();
    }

    // ===== UTILITY FUNCTIONS =====

    /**
     * Debounce function to limit function call frequency
     * @param {Function} func - Function to debounce
     * @param {number} delay - Delay in milliseconds
     * @returns {Function} - Debounced function
     */
    function debounce(func, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // ===== TOKEN CALCULATION =====

    let previousTokenInputValue = null;

    /**
     * Handle token input changes and validation
     */
    function handleTokenInput() {
        const tokenInput = document.getElementById('requested_token_count');
        const minInvest = parseInt(document.getElementById('min_invest').value);
        const maxInvest = parseInt(document.getElementById('max_invest').value);
        const errorText = document.getElementById('token_error');
        const requestedTokens = parseInt(tokenInput.value);

        // Avoid duplicate processing
        if (tokenInput.value === previousTokenInputValue) return;
        previousTokenInputValue = tokenInput.value;

        if (!isNaN(requestedTokens) && requestedTokens > maxInvest) {
            errorText.classList.remove('d-none');
            errorText.innerText = `Maximum token purchase: ${maxInvest}`;
            updateTokenValuesToZero();
            return;
        }

        if (!isNaN(requestedTokens) && requestedTokens < minInvest) {
            errorText.classList.remove('d-none');
            errorText.innerText = `Minimum token purchase: ${minInvest}`;
            updateTokenValuesToZero();
            return;
        }

        // Input is valid
        if (!isNaN(requestedTokens) && requestedTokens >= minInvest && requestedTokens <= maxInvest) {
            errorText.classList.add('d-none');
            fetchTokenCalculation(requestedTokens);
        }
    }

    /**
     * Reset token values to zero
     */
    function updateTokenValuesToZero() {
        document.getElementById('amount').value = 0;
        document.getElementById('total_token_value').innerText = '0.00';
        document.getElementById('bonus_token').value = '';
        document.getElementById('total_token').value = '';
        document.getElementById('submit_btn')?.setAttribute('disabled', true);
    }

    /**
     * Fetch token calculation from server
     * @param {number} requestedTokens - Number of tokens requested
     */
    function fetchTokenCalculation(requestedTokens) {
        const contract_id = document.getElementById('contract_id').value;
        const payment_id = document.getElementById('payby').value;

        $.ajax({
            url: "{{ url('/gettokeninvestvalue') }}",
            type: "POST",
            data: {
                token_id: contract_id,
                no_of_token: requestedTokens,
                payment_id: payment_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(results) {
                if (results.status == 1) {
                    $('#amount').val(results.token_equ_value);
                    $('#bonus_token').val(results.bonus_token);
                    $('#total_token').val(results.total_token);
                    $('#total_token_value').text(results.token_equ_value);
                    $('#submit_btn').attr('disabled', false);
                } else {
                    updateTokenValuesToZero();
                }
            },
            error: function() {
                updateTokenValuesToZero();
                console.error("Failed to fetch token calculation.");
            }
        });
    }

    // ===== INITIALIZATION =====

    /**
     * Initialize all event handlers when DOM is loaded
     */
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize payment handlers
        initializePaymentHandlers();
        initializeBankSelector();
        initializeCryptoSelector();
        initializePaymentSections();

        // Initialize token input handling
        handleTokenInput();
        const inputField = document.getElementById('requested_token_count');
        if (inputField) {
            inputField.addEventListener('input', debounce(handleTokenInput, 800));
        }

        // Initialize stage toggle icons
        document.querySelectorAll(".stage-toggle-icon").forEach(function(icon) {
            icon.addEventListener("click", function() {
                const targetSelector = this.getAttribute("data-target");
                const target = document.querySelector(targetSelector);

                if (target) {
                    const isCollapsed = target.classList.toggle("collapsed");
                    this.classList.toggle("rotate", isCollapsed);
                    this.classList.toggle("fa-plus", !isCollapsed);
                    this.classList.toggle("fa-minus", isCollapsed);
                }
            });
        });
    });
</script>
@endsection