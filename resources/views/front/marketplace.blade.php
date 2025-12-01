@extends('front.layout.main')

@section('title')
    Marketplace - TokenEasy Property Investment Platform
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="section-py landing-hero position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-text-box">
                        <h1 class="text-white hero-title display-4 fw-bold mb-4">
                            Discover Premium Investment Opportunities
                        </h1>
                        <p class="text-white-50 h5 mb-5">
                            Explore our curated selection of tokenized real estate properties with active status.
                            Invest in promising projects with transparent returns.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#properties" class="btn btn-light btn-lg">View Properties</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-light.png') }}"
                             alt="Marketplace" class="img-fluid" style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section-py bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="text-primary fw-bold">{{ $properties->count() }}</h3>
                            <p class="text-muted mb-0">Active Properties</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="text-success fw-bold">${{ number_format($properties->sum('totalDealSize')) }}</h3>
                            <p class="text-muted mb-0">Total Deal Size</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="text-info fw-bold">{{ number_format($properties->avg('expectedIrr'), 1) }}%</h3>
                            <p class="text-muted mb-0">Avg Expected IRR</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="text-warning fw-bold">{{ number_format($properties->avg('dividend'), 1) }}%</h3>
                            <p class="text-muted mb-0">Avg Dividend Yield</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Properties Section -->
    <section id="properties" class="section-py" style="background-color: #f8f9fa;">
        <div class="container px-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Active Investment Opportunities</h2>
                <p class="text-muted h5">Browse through our carefully selected properties with active status</p>
            </div>

            @if($properties->count() > 0)
                <div class="row">
                    @foreach($properties as $property)

                        <div class="col-lg-6 col-md-6 mb-5" >
                            <div class="card h-100 shadow-sm border property-card" id="property{{$property->id}}">
                                <!-- Property Image -->
                                <div class="position-relative">
                                    @if($property->main_image)
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $property->main_image->image) }}"
                                                 class="card-img-top" alt="{{ $property->propertyName }}"
                                                 style="height: 300px; object-fit: cover;">

                                            <!-- Watermark Overlay -->
                                            @if($isDemo)
                                            <div class="watermark-overlay">
                                                <div class="watermark-text">
                                                    Test
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                             style="height: 300px;">
                                            <i class="fas fa-building fa-3x text-muted"></i>
                                        </div>
                                    @endif

                                    <!-- Status Badge -->
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-success">@if($isDemo) Test @else Active @endif</span>
                                    </div>

                                    <!-- Token Type Badge -->
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-primary">
                                            @if($property->token_type == 1)
                                                Property Token
                                            @elseif($property->token_type == 2)
                                                Asset Token
                                            @else
                                                Token
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Blinking Invest Button -->
                                    <div class="position-absolute bottom-0 start-0 end-0 p-3">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('front.purchase', $property->id) }}" class="btn btn-warning btn-lg invest-btn-blinking">
                                                <div class="sparkle"></div>
                                                <div class="sparkle"></div>
                                                <div class="sparkle"></div>
                                                <div class="sparkle"></div>
                                                <i class="fas fa-chart-line me-2"></i>INVEST NOW
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <!-- Property Name -->
                                    <h5 class="card-title fw-bold mb-2">{{ $property->propertyName }}</h5>

                                    <!-- Location -->
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        {{ $property->propertyLocation }}
                                    </p>

                                    <!-- Property Overview -->
                                    @if($property->propertyOverview)
                                        <div class="mb-3">
                                            <p class="text-muted small mb-2">
                                                {{ \Illuminate\Support\Str::limit($property->propertyOverview, 150) }}
                                            </p>
                                        </div>
                                    @endif

                                    <!-- Location Overview -->
                                    @if($property->propertyConnectivityOverview || $property->airport || $property->hospitals || $property->distance_fm_mainroad)
                                        <div class="mb-3">
                                            <h6 class="fw-bold text-primary mb-2">Location & Connectivity</h6>
                                            @if($property->propertyConnectivityOverview)
                                                <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($property->propertyConnectivityOverview, 120) }}</p>
                                            @endif
                                            <div class="row g-2">
                                                @if($property->airport)
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-plane text-primary me-2"></i>
                                                            <small class="text-muted">Airport: {{ $property->airport }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($property->hospitals)
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-hospital text-primary me-2"></i>
                                                            <small class="text-muted">Hospitals: {{ $property->hospitals }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($property->distance_fm_mainroad)
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-road text-primary me-2"></i>
                                                            <small class="text-muted">Main Road: {{ $property->distance_fm_mainroad }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($property->railway_tracks)
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-train text-primary me-2"></i>
                                                            <small class="text-muted">Railway: {{ $property->railway_tracks }}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Property Highlights -->
                                    @if($property->propertyHighlights)
                                        <div class="mb-3">
                                            <h6 class="fw-bold text-primary mb-2">Highlights</h6>
                                            <div class="row g-2">
                                                @foreach(explode(',', $property->propertyHighlights) as $highlight)
                                                    @if(trim($highlight))
                                                        <div class="col-6">
                                                            <span class="badge bg-light text-dark small">
                                                                <i class="fas fa-check-circle text-success me-1"></i>
                                                                {{ trim($highlight) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Key Metrics -->
                                    <div class="row mb-3">
                                        <div class="col-6 mb-2">
                                            <div class="metric-box">
                                                <div class="fw-bold text-primary h5 mb-1">{{ number_format($property->expectedIrr, 1) }}%</div>
                                                <small class="text-muted">Expected IRR</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="metric-box">
                                                <div class="fw-bold text-success h5 mb-1">{{ number_format($property->dividend, 1) }}%</div>
                                                <small class="text-muted">Dividend Yield</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="metric-box">
                                                <div class="fw-bold text-info h5 mb-1">{{ $property->propertyEquityMultiple }}x</div>
                                                <small class="text-muted">Equity Multiple</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="metric-box">
                                                <div class="fw-bold text-warning h5 mb-1">{{ $property->holdingPeriod }}</div>
                                                <small class="text-muted">Holding Period</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Deal Size -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Deal Size:</span>
                                            <span class="fw-bold">${{ number_format($property->totalDealSize) }}</span>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    @if($property->userContract)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <small class="text-muted">Tokens Sold</small>
                                                <small class="fw-bold">{{ $property->sold_percentage }}%</small>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success"
                                                     style="width: {{ $property->sold_percentage }}%"></div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Investment Progress -->
                                    @if($property->userContract)
                                        <div class="mb-3">
                                            <h6 class="fw-bold text-primary mb-2">Investment Progress</h6>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="fw-bold">Funding Progress</span>
                                                        <span class="fw-bold text-success">{{ $property->sold_percentage }}%</span>
                                                    </div>
                                                    <div class="progress mb-3" style="height: 12px;">
                                                        <div class="progress-bar bg-success"
                                                             style="width: {{ $property->sold_percentage }}%"
                                                             role="progressbar"
                                                             aria-valuenow="{{ $property->sold_percentage }}"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-center p-2 bg-light rounded">
                                                        <div class="fw-bold text-primary">${{ number_format($property->accuired_usd) }}</div>
                                                        <small class="text-muted">Raised</small>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-center p-2 bg-light rounded">
                                                        <div class="fw-bold text-info">${{ number_format($property->totalDealSize - $property->accuired_usd) }}</div>
                                                        <small class="text-muted">Remaining</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Property Type -->
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark">{{ $property->propertyType }}</span>
                                        @if($property->locality)
                                            <span class="badge bg-light text-dark">{{ $property->locality }}</span>
                                        @endif
                                        @if($property->yearOfConstruction)
                                            <span class="badge bg-light text-dark">{{ $property->yearOfConstruction }}</span>
                                        @endif
                                    </div>

                                    <!-- Property Specifications -->
                                    <div class="mb-3">
                                        <h6 class="fw-bold text-primary mb-2">Property Specifications</h6>
                                        <div class="row g-2">
                                            @if($property->storeys)
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Storeys:</small>
                                                        <span class="fw-bold small">{{ $property->storeys }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($property->typicalFloorArea)
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Floor Area:</small>
                                                        <span class="fw-bold small">{{ number_format($property->typicalFloorArea) }} sq ft</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($property->propertyTotalBuildingArea)
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Total Area:</small>
                                                        <span class="fw-bold small">{{ number_format($property->propertyTotalBuildingArea) }} sq ft</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($property->propertyParking)
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Parking:</small>
                                                        <span class="fw-bold small">{{ $property->propertyParking }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Asset Information -->
                                    <div class="mb-3">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Asset Type:</small>
                                                    <span class="fw-bold small">
                                                        @if($property->token_type == 1)
                                                            Property Token
                                                        @elseif($property->token_type == 2)
                                                            Asset Token
                                                        @else
                                                            Token
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Expected Return:</small>
                                                    <span class="fw-bold text-success small">{{ number_format($property->expectedIrr, 1) }}%</span>
                                                </div>
                                            </div>
                                            @if($property->userContract)
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Total Tokens:</small>
                                                        <span class="fw-bold small">{{ number_format($property->userContract->tokensupply) }} {{ $property->userContract->tokensymbol ?? 'MTKN' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Remaining:</small>
                                                        <span class="fw-bold small">{{ number_format($property->userContract->tokenbalance) }} {{ $property->userContract->tokensymbol ?? 'MTKN' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Token Price:</small>
                                                        <span class="fw-bold small">${{ number_format($property->userContract->tokenvalue, 4) }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Total Tokens:</small>
                                                        <span class="fw-bold small">N/A</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Remaining:</small>
                                                        <span class="fw-bold small">N/A</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Token Price:</small>
                                                        <span class="fw-bold small">N/A</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-6">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Min Investment:</small>
                                                    <span class="fw-bold small">${{ number_format($property->initialInvestment) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">Asset Status:</small>
                                                    <span class="badge bg-success small">Active</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contract Address -->
                                        <div class="mt-2 p-2 bg-light rounded">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Contract Address:</small>
                                                @if($property->userContract && $property->userContract->contract_address && $property->contract_link)
                                                    <div class="text-end">
                                                        @if($property->coin)
                                                            <small class="text-muted d-block">{{ $property->coin }}</small>
                                                        @endif
                                                        <a href="{{ $property->contract_link }}" target="_blank" rel="noopener noreferrer" class="fw-bold small text-primary text-decoration-none contract-link"
                                                           data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $property->userContract->contract_address }}">
                                                            {{ substr($property->userContract->contract_address, 0, 6) }}...{{ substr($property->userContract->contract_address, -4) }}
                                                            <i class="fas fa-external-link-alt ms-1" style="font-size: 0.7em;"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <span class="fw-bold small text-muted">Not Available</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('front.property.detail', $property->id) }}"
                                           class="btn btn-primary">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                        @if(!Auth::check())
                                            <a href="{{ route('register') }}"
                                               class="btn btn-outline-primary">
                                                <i class="fas fa-user-plus me-2"></i>Register to Invest
                                            </a>
                                        @else
                                            <a href="{{ route('front.purchase', $property->id) }}"
                                               class="btn btn-outline-success">
                                                <i class="fas fa-chart-line me-2"></i>Ready to Invest
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <small class="text-muted d-block">Total Deal Size</small>
                                            <span class="fw-bold h6">${{ number_format($property->totalDealSize) }}</span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Min Investment</small>
                                            <span class="fw-bold h6">${{ number_format($property->initialInvestment) }}</span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Status</small>
                                            <span class="badge bg-success">Active</span>
                                        </div>
                                    </div>
                                    @if($property->userContract)
                                        <div class="row text-center mt-2">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Token Price</small>
                                                <span class="fw-bold h6">${{ number_format($property->userContract->tokenvalue, 4) }}</span>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Token Symbol</small>
                                                <span class="fw-bold h6">{{ $property->userContract->tokensymbol ?? 'MTKN' }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-3x text-muted"></i>
                    </div>
                    <h4 class="text-muted">No Active Properties Available</h4>
                    <p class="text-muted">Check back soon for new investment opportunities!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-py bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Ready to Start Investing?</h3>
                    <p class="mb-0">Join thousands of investors who are already building wealth through tokenized real estate.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-rocket me-2"></i>Get Started Today
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .property-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        min-height: 800px;
        border: 2px solid #e9ecef !important;
        border-radius: 12px !important;
    }

    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
        border-color: #007bff !important;
    }

    /* Anchor highlight styles */
    .property-card.border-success {
        border-color: #198754 !important;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25) !important;
        animation: highlightPulse 2s ease-in-out;
    }

    @keyframes highlightPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }

    .hero-title {
        font-size: 3rem;
        line-height: 1.2;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .property-card {
            min-height: auto;
        }
    }

    .progress {
        border-radius: 10px;
    }

    .progress-bar {
        border-radius: 10px;
    }

    /* Contract address link styles */
    .contract-link {
        transition: all 0.3s ease;
        word-break: break-all;
    }

    .contract-link:hover {
        color: #0056b3 !important;
        text-decoration: underline !important;
    }

    .contract-link:focus {
        outline: 2px solid #007bff;
        outline-offset: 2px;
    }

    /* Enhanced card styling */
    .property-card .card-body {
        padding: 1.5rem;
    }

    .property-card .card-title {
        font-size: 1.4rem;
        line-height: 1.3;
    }

    .property-card .bg-light {
        background-color: #f8f9fa !important;
        border: 1px solid #e9ecef;
    }

    .property-card .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
    }

    .property-card h6 {
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
    }

    .property-card .text-muted {
        color: #6c757d !important;
    }

    /* Metric boxes styling */
    .metric-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
    }

    .metric-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .metric-box .h5 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    /* Location icons styling */
    .location-icon {
        width: 16px;
        height: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
    }

    /* Card spacing and layout */
    .row {
        margin-left: -1rem;
        margin-right: -1rem;
    }

    .col-lg-6, .col-md-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    /* Enhanced card header styling */
    .property-card .card-img-top {
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }

    /* Card footer styling */
    .property-card .card-footer {
        border-top: 1px solid #e9ecef;
        background-color: #f8f9fa;
        border-bottom-left-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }

    /* Smooth scrolling for anchor links */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 100px; /* Adjust based on your header height */
    }

    /* Ensure property cards have proper scroll targets */
    .property-card {
        scroll-margin-top: 100px; /* Adjust based on your header height */
    }

    /* Blinking Invest Button */
    .invest-btn-blinking {
        animation: superBlink 2s infinite, neonPulse 1.5s infinite, float 3s ease-in-out infinite;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 1.1rem;
        padding: 15px 30px;
        border: 3px solid #dc3545;
        background: linear-gradient(45deg, #dc3545, #fd7e14, #ff6b35, #e74c3c);
        background-size: 300% 300%;
        color: #fff !important;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        box-shadow:
            0 0 20px rgba(220, 53, 69, 0.8),
            0 0 40px rgba(220, 53, 69, 0.6),
            0 0 60px rgba(220, 53, 69, 0.4),
            inset 0 0 20px rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        backdrop-filter: blur(5px);
    }

    .invest-btn-blinking:hover {
        transform: scale(1.1) translateY(-5px);
        box-shadow:
            0 0 30px rgba(220, 53, 69, 1),
            0 0 60px rgba(220, 53, 69, 0.8),
            0 0 90px rgba(220, 53, 69, 0.6),
            inset 0 0 30px rgba(255, 255, 255, 0.3);
        background: linear-gradient(45deg, #e74c3c, #ff6b35, #fd7e14, #dc3545);
        background-size: 300% 300%;
        animation: superBlink 0.5s infinite, neonPulse 0.8s infinite, float 1s ease-in-out infinite;
        color: #fff !important;
    }

    .invest-btn-blinking::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
        transition: left 0.8s;
        z-index: 1;
    }

    .invest-btn-blinking:hover::before {
        left: 100%;
    }

    .invest-btn-blinking::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 0deg, transparent, rgba(220, 53, 69, 0.3), transparent);
        animation: rotate 3s linear infinite;
        z-index: 0;
    }

    @keyframes superBlink {
        0% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            filter: brightness(1) contrast(1);
        }
        25% {
            opacity: 0.9;
            transform: scale(1.05) rotate(1deg);
            filter: brightness(1.2) contrast(1.1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.1) rotate(0deg);
            filter: brightness(1.4) contrast(1.2);
        }
        75% {
            opacity: 0.9;
            transform: scale(1.05) rotate(-1deg);
            filter: brightness(1.2) contrast(1.1);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            filter: brightness(1) contrast(1);
        }
    }

    @keyframes neonPulse {
        0%, 100% {
            box-shadow:
                0 0 20px rgba(220, 53, 69, 0.8),
                0 0 40px rgba(220, 53, 69, 0.6),
                0 0 60px rgba(220, 53, 69, 0.4),
                inset 0 0 20px rgba(255, 255, 255, 0.2);
        }
        50% {
            box-shadow:
                0 0 30px rgba(220, 53, 69, 1),
                0 0 60px rgba(220, 53, 69, 0.8),
                0 0 90px rgba(220, 53, 69, 0.6),
                inset 0 0 30px rgba(255, 255, 255, 0.3);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-3px);
        }
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    /* Ensure button is visible over the image */
    .position-relative .position-absolute.bottom-0 {
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.4));
        backdrop-filter: blur(3px);
        padding: 20px 15px 15px 15px;
    }

    /* Add sparkle effect */
    .invest-btn-blinking .sparkle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #fff;
        border-radius: 50%;
        animation: sparkle 2s infinite;
    }

    .invest-btn-blinking .sparkle:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .invest-btn-blinking .sparkle:nth-child(2) { top: 20%; right: 15%; animation-delay: 0.5s; }
    .invest-btn-blinking .sparkle:nth-child(3) { bottom: 15%; left: 20%; animation-delay: 1s; }
    .invest-btn-blinking .sparkle:nth-child(4) { bottom: 25%; right: 10%; animation-delay: 1.5s; }

    @keyframes sparkle {
        0%, 100% { opacity: 0; transform: scale(0); }
        50% { opacity: 1; transform: scale(1); }
    }

    /* Watermark Overlay Styles */
    .watermark-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none; /* Allow clicks to pass through to the image */
        z-index: 1; /* Ensure it's above the image */
    }

    .watermark-text {
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        backdrop-filter: blur(5px); /* Add a blur effect to the background */
        -webkit-backdrop-filter: blur(5px); /* For Safari */
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Handle anchor fragments for property highlighting
        function handleAnchorFragment() {
            const hash = window.location.hash;
            if (hash && hash.startsWith('#property')) {
                const propertyId = hash.replace('#property', '');
                const propertyCard = document.getElementById('property' + propertyId);

                if (propertyCard) {
                    // Remove existing highlights
                    document.querySelectorAll('.property-card').forEach(card => {
                        card.classList.remove('border-success', 'border-3');
                    });

                    // Add highlight to the target property
                    propertyCard.classList.add('border-success', 'border-3');

                    // Scroll to the property card with offset for fixed header
                    const headerHeight = 80; // Adjust this value based on your header height
                    const cardTop = propertyCard.offsetTop - headerHeight - 20; // 20px extra padding

                    window.scrollTo({
                        top: cardTop,
                        behavior: 'smooth'
                    });
                }
            }
        }

        // Handle anchor on page load
        handleAnchorFragment();

        // Handle anchor changes (if user clicks on anchor links)
        window.addEventListener('hashchange', function() {
            handleAnchorFragment();
        });

        // Utility functions for anchor management
        window.MarketplaceAnchors = {
            // Get current property ID from anchor
            getCurrentPropertyId: function() {
                const hash = window.location.hash;
                if (hash && hash.startsWith('#property')) {
                    return hash.replace('#property', '');
                }
                return null;
            },

            // Set anchor for a specific property
            setPropertyAnchor: function(propertyId) {
                window.location.hash = 'property' + propertyId;
            },

            // Clear anchor
            clearAnchor: function() {
                history.pushState("", document.title, window.location.pathname + window.location.search);
            },

            // Check if a property is currently highlighted
            isPropertyHighlighted: function(propertyId) {
                return this.getCurrentPropertyId() === propertyId.toString();
            },

            // Manually scroll to a property card
            scrollToProperty: function(propertyId) {
                const propertyCard = document.getElementById('property' + propertyId);
                if (propertyCard) {
                    // Remove existing highlights
                    document.querySelectorAll('.property-card').forEach(card => {
                        card.classList.remove('border-success', 'border-3');
                    });

                    // Add highlight to the target property
                    propertyCard.classList.add('border-success', 'border-3');

                    // Calculate scroll position with header offset
                    const headerHeight = 100; // Adjust based on your header height
                    const cardTop = propertyCard.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: Math.max(0, cardTop), // Ensure we don't scroll to negative values
                        behavior: 'smooth'
                    });
                }
            },

            // Get header height dynamically
            getHeaderHeight: function() {
                const header = document.querySelector('header, .navbar, .main-header');
                return header ? header.offsetHeight : 100;
            }
        };
    });
</script>
@endpush