@extends('front.layout.main')

@section('title')
    {{ $property->propertyName }} - TokenEasy Property Investment Platform
@endsection

@section('content')
    <!-- Property Hero Section -->
    <section class="section-py position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('marketplace') }}" class="text-white-50">Marketplace</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $property->propertyName }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-white hero-title display-5 fw-bold mb-3">
                        {{ $property->propertyName }}
                    </h1>
                    <p class="text-white-50 h5 mb-4">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ $property->propertyLocation }}
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('front.purchase', $property->id) }}" class="btn btn-light btn-lg">
                            <i class="fas fa-chart-line me-2"></i>Invest Now
                        </a>
                        <a href="#details" class="btn btn-outline-light btn-lg">View Details</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        @if($property->main_image)
                            <img src="{{ asset('storage/' . $property->main_image->image) }}"
                                 alt="{{ $property->propertyName }}" class="img-fluid rounded shadow-lg"
                                 style="max-height: 300px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded shadow-lg d-flex align-items-center justify-content-center"
                                 style="height: 300px;">
                                <i class="fas fa-building fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="section-py bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="text-primary fw-bold">{{ number_format($property->expectedIrr, 1) }}%</h3>
                            <p class="text-muted mb-0">Expected IRR</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="text-success fw-bold">{{ number_format($property->dividend, 1) }}%</h3>
                            <p class="text-muted mb-0">Dividend Yield</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="text-info fw-bold">${{ number_format($property->totalDealSize) }}</h3>
                            <p class="text-muted mb-0">Total Deal Size</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="text-warning fw-bold">{{ $property->holdingPeriod }}</h3>
                            <p class="text-muted mb-0">Holding Period</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Property Details Section -->
    <section id="details" class="section-py">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Property Images Gallery -->
                    @if($property->all_images && $property->all_images->count() > 0)
                        <div class="mb-5">
                            <h3 class="fw-bold mb-4">Property Gallery</h3>
                            <div class="row g-3">
                                @foreach($property->all_images->take(6) as $image)
                                    <div class="col-md-6 col-lg-4">
                                        <img src="{{ asset('storage/' . $image->image) }}"
                                             alt="{{ $property->propertyName }}"
                                             class="img-fluid rounded shadow-sm"
                                             style="height: 200px; width: 100%; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Property Overview -->
                    @if($property->propertyOverview)
                        <div class="mb-5">
                            <h3 class="fw-bold mb-3">Property Overview</h3>
                            <p class="text-muted lead">{{ $property->propertyOverview }}</p>
                        </div>
                    @endif

                    <!-- Property Highlights -->
                    @if($property->propertyHighlights)
                        <div class="mb-5">
                            <h3 class="fw-bold mb-3">Property Highlights</h3>
                            <div class="row g-3">
                                @foreach(explode(',', $property->propertyHighlights) as $highlight)
                                    @if(trim($highlight))
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <i class="fas fa-check-circle text-success me-3"></i>
                                                <span>{{ trim($highlight) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Property Specifications -->
                    <div class="mb-5">
                        <h3 class="fw-bold mb-3">Property Specifications</h3>
                        <div class="row g-3">
                            @if($property->propertyType)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Property Type</span>
                                        <span class="fw-bold">{{ $property->propertyType }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->locality)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Locality</span>
                                        <span class="fw-bold">{{ $property->locality }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->yearOfConstruction)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Year of Construction</span>
                                        <span class="fw-bold">{{ $property->yearOfConstruction }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->storeys)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Storeys</span>
                                        <span class="fw-bold">{{ $property->storeys }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->typicalFloorArea)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Floor Area</span>
                                        <span class="fw-bold">{{ number_format($property->typicalFloorArea) }} sq ft</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->propertyTotalBuildingArea)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Total Building Area</span>
                                        <span class="fw-bold">{{ number_format($property->propertyTotalBuildingArea) }} sq ft</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->propertyParking)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Parking</span>
                                        <span class="fw-bold">{{ $property->propertyParking }}</span>
                                    </div>
                                </div>
                            @endif
                            @if($property->propertyEquityMultiple)
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <span class="text-muted">Equity Multiple</span>
                                        <span class="fw-bold">{{ $property->propertyEquityMultiple }}x</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Location & Connectivity -->
                    @if($property->propertyConnectivityOverview || $property->airport || $property->hospitals || $property->distance_fm_mainroad)
                        <div class="mb-5">
                            <h3 class="fw-bold mb-3">Location & Connectivity</h3>
                            @if($property->propertyConnectivityOverview)
                                <p class="text-muted mb-4">{{ $property->propertyConnectivityOverview }}</p>
                            @endif
                            <div class="row g-3">
                                @if($property->airport)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                            <i class="fas fa-plane text-primary me-3"></i>
                                            <div>
                                                <div class="fw-bold">Airport</div>
                                                <small class="text-muted">{{ $property->airport }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($property->hospitals)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                            <i class="fas fa-hospital text-primary me-3"></i>
                                            <div>
                                                <div class="fw-bold">Hospitals</div>
                                                <small class="text-muted">{{ $property->hospitals }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($property->distance_fm_mainroad)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                            <i class="fas fa-road text-primary me-3"></i>
                                            <div>
                                                <div class="fw-bold">Main Road</div>
                                                <small class="text-muted">{{ $property->distance_fm_mainroad }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($property->railway_tracks)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                            <i class="fas fa-train text-primary me-3"></i>
                                            <div>
                                                <div class="fw-bold">Railway</div>
                                                <small class="text-muted">{{ $property->railway_tracks }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Property Updates -->
                    @if($property->updates && $property->updates->count() > 0)
                        <div class="mb-5">
                            <h3 class="fw-bold mb-3">Property Updates</h3>
                            <div class="timeline">
                                @foreach($property->updates->take(5) as $update)
                                    <div class="timeline-item mb-3">
                                        <div class="d-flex">
                                            <div class="timeline-marker bg-primary rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold">{{ $update->title }}</div>
                                                <div class="text-muted small">{{ $update->date ? \Carbon\Carbon::parse($update->date)->format('M d, Y') : '' }}</div>
                                                <p class="text-muted mt-2">{{ $update->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Investment Card -->
                    <div class="card shadow-sm border-0 sticky-top" style="top: 2rem;">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Investment Details</h4>

                            <!-- Investment Progress -->
                            @if($property->userContract)
                                <div class="mb-4">
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
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <div class="fw-bold text-primary">${{ number_format($property->accuired_usd) }}</div>
                                            <small class="text-muted">Raised</small>
                                        </div>
                                        <div class="col-6">
                                            <div class="fw-bold text-info">${{ number_format($property->totalDealSize - $property->accuired_usd) }}</div>
                                            <small class="text-muted">Remaining</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Key Metrics -->
                            <div class="mb-4">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <div class="fw-bold text-primary">{{ number_format($property->expectedIrr, 1) }}%</div>
                                            <small class="text-muted">Expected IRR</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <div class="fw-bold text-success">{{ number_format($property->dividend, 1) }}%</div>
                                            <small class="text-muted">Dividend Yield</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <div class="fw-bold text-info">{{ $property->propertyEquityMultiple }}x</div>
                                            <small class="text-muted">Equity Multiple</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <div class="fw-bold text-warning">{{ $property->holdingPeriod }}</div>
                                            <small class="text-muted">Holding Period</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Token Information -->
                            @if($property->userContract)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-primary mb-2">Token Information</h6>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Token Price:</small>
                                                <span class="fw-bold">${{ number_format($property->userContract->tokenvalue, 4) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Token Symbol:</small>
                                                <span class="fw-bold">{{ $property->userContract->tokensymbol ?? 'MTKN' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Total Supply:</small>
                                                <span class="fw-bold">{{ number_format($property->userContract->tokensupply) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Available:</small>
                                                <span class="fw-bold">{{ number_format($property->userContract->tokenbalance) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contract Address -->
                                    @if($property->userContract->contract_address && $property->contract_link)
                                        <div class="mt-3 p-2 bg-light rounded">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Contract:</small>
                                                <a href="{{ $property->contract_link }}" target="_blank" rel="noopener noreferrer"
                                                   class="fw-bold small text-primary text-decoration-none contract-link"
                                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="{{ $property->userContract->contract_address }}">
                                                    {{ substr($property->userContract->contract_address, 0, 6) }}...{{ substr($property->userContract->contract_address, -4) }}
                                                    <i class="fas fa-external-link-alt ms-1" style="font-size: 0.7em;"></i>
                                                </a>
                                            </div>
                                            @if($property->coin)
                                                <small class="text-muted d-block text-center mt-1">{{ $property->coin }}</small>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Investment Actions -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('front.purchase', $property->id) }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-chart-line me-2"></i>Invest Now
                                </a>
                                <a href="{{ route('marketplace') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Marketplace
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Properties Section -->
    @if($relatedProperties && $relatedProperties->count() > 0)
        <section class="section-py bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h3 class="fw-bold mb-3">Related Properties</h3>
                    <p class="text-muted">Explore other investment opportunities</p>
                </div>
                <div class="row">
                    @foreach($relatedProperties as $relatedProperty)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0 property-card">
                                <!-- Property Image -->
                                <div class="position-relative">
                                    @if($relatedProperty->main_image)
                                        <img src="{{ asset('storage/' . $relatedProperty->main_image->image) }}"
                                             class="card-img-top" alt="{{ $relatedProperty->propertyName }}"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                             style="height: 200px;">
                                            <i class="fas fa-building fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-2">{{ $relatedProperty->propertyName }}</h5>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        {{ $relatedProperty->propertyLocation }}
                                    </p>

                                    <!-- Key Metrics -->
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-light rounded">
                                                <div class="fw-bold text-primary">{{ number_format($relatedProperty->expectedIrr, 1) }}%</div>
                                                <small class="text-muted">Expected IRR</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-light rounded">
                                                <div class="fw-bold text-success">{{ number_format($relatedProperty->dividend, 1) }}%</div>
                                                <small class="text-muted">Dividend Yield</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    @if($relatedProperty->userContract)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <small class="text-muted">Tokens Sold</small>
                                                <small class="fw-bold">{{ $relatedProperty->sold_percentage }}%</small>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success"
                                                     style="width: {{ $relatedProperty->sold_percentage }}%"></div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Action Button -->
                                    <div class="d-grid">
                                        <a href="{{ route('front.property.detail', $relatedProperty->id) }}"
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('styles')
<style>
    .hero-title {
        font-size: 2.5rem;
        line-height: 1.2;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
    }

    .property-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .property-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }

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

    .timeline-marker {
        flex-shrink: 0;
    }

    .sticky-top {
        z-index: 1020;
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
    });
</script>
@endpush