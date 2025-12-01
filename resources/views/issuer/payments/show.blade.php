@php
    $currentRoute = (\Request::getRequestUri() == "/issuer/wallet"? true : false);
@endphp
@extends('issuer.layout.base')
@section('content')
<div class="content-page-inner">
    <div class="content-page-inner">
        <div class="header-breadcrumbs">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1>Bank Accounts</h1>
                            </div>
                            <div class="col-sm-6">
                                @include('issuer.layout.breadcrumb',['items' => [
                                    [
                                        'url' => 'issuer/dashboard',
                                        'title' => 'Dashboard'
                                    ],
                                    [
                                        'title' => 'Bank Accounts'
                                    ]
                                ]])
                            </div>
                        </div>
                    </div>
        </div>

      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="content">
                      <div class="container-fluid p-0">
                          <h5 class="section-title">Manage Bank for fiat Payments</h5>
                          <p class="section-desc">
                                Enter details of bank accounts where you want to receive payments from investors. These banks accounts will be shown to investor where they can send payments while purchasing shares/tokens
                          </p>
                          <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('Bank.getForm') }}" class="btn btn-primary">Add Bank Details</a>
                        </div>
                        <div class="form-group mb-4">
                            <label for="assetSelect">Select Asset</label>
                            <select id="assetSelect" class="form-control" onchange="location = '?asset_id=' + this.value;">
                                @foreach($contracts as $contract)
                                    <option value="{{ $contract->id }}" {{ $selectedAssetId == $contract->id ? 'selected' : '' }}>
                                        {{ $contract->property->propertyName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                          <div class="row mb-4 mx-3 mt-5">
                            <div class="col-12">
                                @if(!empty($banks) && $banks->count() > 0)
                                    {{-- Heading Row --}}
                                    <div class="row fw-bold text-uppercase text-secondary mb-2 px-3">
                                        <div class="col-12 col-md-2">Bank</div>
                                        <div class="col-12 col-md-2">Location</div>
                                        <div class="col-12 col-md-4">Beneficiary Name</div>
                                    </div>

                                    {{-- Bank List --}}
                                    @foreach($banks as $bank)
                                        <div class="row align-items-start my-2 p-3 border rounded"
                                            data-id="{{ $bank->id }}"
                                            data-title="{{ $bank->bank_name }}">

                                            <!-- Bank Name -->
                                            <div class="col-12 col-md-2">
                                                <strong class="d-block text-break">{{ $bank->bank_name }}</strong>
                                            </div>

                                            <!-- Location -->
                                            <div class="col-12 col-md-2">
                                                <strong class="d-block text-break">{{ $bank->bank_location }}</strong>
                                            </div>

                                            <!-- Beneficiary Name -->
                                            <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                <strong class="d-block text-break">{{ $bank->beneficiary_name }}</strong>
                                            </div>

                                            <!-- Actions -->
                                            <div class="col-12 col-md-4 d-flex justify-content-md-end">
                                                <a href="{{ route('issuer.editForm', ['id' => $bank->id]) }}"
                                                class="btn btn-sm btn-secondary me-2">Edit</a>
                                                <a href="{{ route('issuer.viewForm', ['id' => $bank->id]) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            </div>
                                        </div>
                                        @endforeach

                                    {{-- Pagination --}}
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $banks->links() }}
                                    </div>
                                @else
                                    <p>No Bank Details Found.</p>
                                @endif
                            </div>
                        </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>

    </div>
</div>



@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
