@php

@endphp
@extends('issuer.layout.base')
@section('content')
<div class="content-page-inner">
    <div class="header-breadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <h1>Payment Settings</h1> --}}
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
                            <span>Manage Crypto Address</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="content">
            <div class="container-fluid p-0">
              <h5 class="section-title">Manage Blockchain Addresses for Crypto Payments</h5>
              <p class="section-desc">
                @lang('admin.payments.crypto.title')
              </p>

              <form method="POST" action="{{ route('crypto.payments.upsert') }}">
                @csrf

                <!-- Asset Selection Dropdown -->
                <div class="form-group row">
                  <label for="asset-select" class="col-sm-2 col-form-label">Select Asset</label>
                  <div class="col-sm-10">
                    <select id="asset-select" name="contract_id" class="form-control" onchange="location = '?contract_id=' + this.value;">
                      @foreach($contracts as $contract)
                        <option value="{{ $contract->id }}" {{ $selectedContractId == $contract->id ? 'selected' : '' }}>
                          {{ $contract->property->propertyName }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <!-- Blockchain Dropdown -->
                <div class="form-group row mt-3">
                  <label for="blockchain-select" class="col-sm-2 col-form-label">Select Blockchain</label>
                  <div class="col-sm-10">
                    <select id="blockchain-select" class="form-control">
                      @foreach($blockchains as $blockchain)
                        <option value="{{ $blockchain->id }}" {{ $selectedBlockchainId == $blockchain->id ? 'selected' : '' }}>
                          {{ $blockchain->blockchain_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <!-- Stablecoin Address Inputs -->
                @foreach ($walletTypes as $blockchainId => $wallet_type)
                  <div class="stablecoin-group" data-blockchain-id="{{ $blockchainId }}" style="display: none;">
                    @foreach ($wallet_type as $wallet_stablecoin)
                      <div class="form-group row mt-3">
                        <label class="col-sm-2 col-form-label">{{ $wallet_stablecoin['stablecoin']['title'] }}</label>
                        <div class="col-sm-10">
                          <input type="text"
                                class="form-control"
                                name="addresses[{{ $wallet_stablecoin['id'] }}]"
                                value="{{ $savedAddresses[$wallet_stablecoin['id']]['address'] ?? '' }}"
                                placeholder="Enter address for {{ $wallet_stablecoin['stablecoin']['title'] }}">
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endforeach

                <input type="hidden" name="blockchain_id" id="selected-blockchain-id">

                <div class="text-end mt-3">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
  // Show stablecoins of the selected blockchain
  const blockchainSelect = document.getElementById('blockchain-select');
  const stablecoinGroups = document.querySelectorAll('.stablecoin-group');
  const selectedBlockchainInput = document.getElementById('selected-blockchain-id');

  function showStablecoins() {
    const selectedId = blockchainSelect.value;
    selectedBlockchainInput.value = selectedId;

    stablecoinGroups.forEach(group => {
      group.style.display = group.dataset.blockchainId === selectedId ? 'block' : 'none';
    });
  }

  blockchainSelect.addEventListener('change', showStablecoins);
  document.addEventListener('DOMContentLoaded', showStablecoins);
</script>

@endsection
