@extends($layout)

@section('content')
    <!-- Breadcrumb -->
    <div class="min-vh-100 bg-light">
        @if(Auth::check())
          <div class="bg-primary bg-gradient text-white py-4 mb-4 shadow">
              <div class="container-fluid">
                  <div class="row align-items-center">
                      <div class="col-sm-6">
                          <h1 class="fw-bold mb-0">
                              <i class="fas fa-building me-3"></i>Property Details
                          </h1>
                      </div>
                      <div class="col-sm-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/dashboard') }}" class="text-white-50 text-decoration-none">
                                        <i class="fas fa-home me-1"></i>Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/propertyList') }}" class="text-white-50 text-decoration-none">Properties List</a>
                                </li>
                                <li class="breadcrumb-item active text-white" aria-current="page">{{ $property->propertyName }}</li>
                            </ol>
                        </nav>
                      </div>
                  </div>
              </div>
          </div>
        @endif

        <!-- Alerts Section -->
        @if(Auth::check() && Auth::user()->user_type == 1)
            @if($checkWhitelist )
                @if($checkWhitelist->status === 'Cancelled' && $showRejectAlert)
                    <div class="alert alert-danger border-0 shadow-sm" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Issuer Note:</strong> {{ $checkWhitelist->note }}
                    </div>
                @elseif($checkWhitelist->status === 'Pending')
                    <div class="alert alert-info border-0 shadow-sm" role="alert">
                        <i class="fas fa-clock me-2"></i>
                        <strong>Status:</strong> You have sent an approval request. Please wait for the issuer's approval.
                    </div>
                @endif
            @else
                <div class="alert alert-info border-0 shadow-sm" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Important:</strong> If you want to purchase tokens from this asset/property, first you have to send an approval request to the issuer who will review your profile before accepting your purchase request. This approval is needed only on the first purchase; once approved, you can purchase as many times later.
                </div>
            @endif
        @endif

        <div class="py-4">
            <!-- Start container-fluid -->
            <div class="container-fluid">
                <!-- Property Head Starts -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="d-flex align-items-center mb-2">
                                    <img
                                        id="iconImage"
                                        src="{{ @img($property->propertyLogo) }}"
                                        class="rounded-circle me-3"
                                        style="width: 50px; height: 50px; object-fit: contain;"
                                        alt="Main Property Image"
                                    >
                                    <div>
                                        <h2 class="fw-bold mb-1">
                                            {{ @$property->propertyName }}
                                            <span class="badge bg-primary ms-2">
                                                @if($property->token_type == 1)
                                                    Property Token
                                                @elseif($property->token_type == 2)
                                                    Asset Token
                                                @elseif($property->token_type == 3)
                                                    Utility Token
                                                @endif
                                            </span>
                                        </h2>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            {{ @$property->propertyLocation }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 text-end">
                                @if (Auth::check())
                                    @if(Auth::user()->user_type == 1)
                                        @if($property->property_state == 'comingsoon')
                                            <button class="btn btn-secondary btn-lg" disabled>
                                                <i class="fas fa-clock me-2"></i>Coming Soon
                                            </button>
                                        @elseif ($property->userContract->tokenbalance > 0)
                                            <a href="{{ url('applyInvest/'.$property->id) }}" class="btn btn-success btn-lg">
                                                <i class="fas fa-chart-line me-2"></i>
                                                @if(@$checkWhitelist->status == 'Pending')
                                                    Waiting for approval
                                                @elseif(@$checkWhitelist->status == 'Approved')
                                                    Purchase
                                                @elseif(@$checkWhitelist->status == 'Cancelled')
                                                    Request Rejected
                                                @else
                                                    Ready to Invest
                                                @endif
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <a href="/profile" class="btn btn-success btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Invest
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Property Head Ends -->

                <!-- Property Content Starts -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-body p-4">
                        <!-- Property Image Section Starts -->
                        <div class="row">
                            <!-- Property-img-box Starts -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">
                                            <i class="fas fa-images me-2"></i>Property Images
                                        </h5>

                                        <!-- Main Image -->
                                        <div class="mb-4">
                                            <img
                                                id="mainImage"
                                                src="{{ @img($property->propertyImages[0]->image) }}"
                                                class="img-fluid rounded shadow-sm"
                                                style="max-height: 400px; object-fit: contain;"
                                                alt="Main Property Image"
                                            >
                                        </div>
                                    </div>

                                    @if ($property->propertyImages && count($property->propertyImages) > 0)
                                        <!-- Thumbnails -->
                                        <div class="card-body pt-0">
                                            <h6 class="text-muted mb-3">Gallery</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($property->propertyImages as $img)
                                                    <img
                                                        src="{{ img($img->image) }}"
                                                        class="img-thumbnail"
                                                        style="width: 80px; height: 60px; object-fit: cover; cursor: pointer;"
                                                        alt="Thumbnail"
                                                        onclick="document.getElementById('mainImage').src = this.src"
                                                    >
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Property Image Right Starts -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <div class="card-body p-4">
                                        <h5 class="fw-bold mb-4 text-white">
                                            <i class="fas fa-chart-bar me-2"></i>Investment Details
                                        </h5>

                                        <!-- Property Detail Boxes -->
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-4 col-md-6">
                                                                <p class="text-white fw-semibold mb-0">
                                                                    <i class="fas fa-percentage me-2"></i>Expected Annual Return
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 col-md-6">
                                                                <p class="fw-bold fs-5 mb-0 text-white">{{ @$property->expectedIrr }}%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-4 col-md-6">
                                                                <p class="text-white fw-semibold mb-0">
                                                                    <i class="fas fa-calendar-alt me-2"></i>Expected Holding period
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 col-md-6">
                                                                <p class="fw-bold fs-5 mb-0 text-white">{{ @$property->holdingPeriod }} years</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-4 col-md-6">
                                                                <p class="text-white fw-semibold mb-0">
                                                                    <i class="fas fa-dollar-sign me-2"></i>Minimum Investment
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 col-md-6">
                                                                <p class="fw-bold fs-5 mb-0 text-white">${{ @$property->initialInvestment }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($property->token_type == 2)
                                                <div class="col-12">
                                                    <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4 col-md-6">
                                                                    <p class="text-white fw-semibold mb-0">
                                                                        <i class="fas fa-users me-2"></i>Funded members
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-8 col-md-6">
                                                                    <p class="fw-bold fs-5 mb-0 text-white">{{ @$property->fundedMembers }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-12">
                                                <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-4 col-md-6">
                                                                <p class="text-white fw-semibold mb-0">
                                                                    <i class="fas fa-coins me-2"></i>Total Tokens
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 col-md-6">
                                                                <p class="fw-bold fs-5 mb-0 text-white">{{ @$property->userContract->tokensupply ?? 0 }} {{$property->userContract->tokensymbol}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-4 col-md-6">
                                                                <p class="text-white fw-semibold mb-0">
                                                                    <i class="fas fa-wallet me-2"></i>Remaining Tokens
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 col-md-6">
                                                                <p class="fw-bold fs-5 mb-0 text-white">{{ @$property->userContract->tokenbalance ?? 0 }} {{$property->userContract->tokensymbol}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-4 col-md-6">
                                                                <p class="text-white fw-semibold mb-0">
                                                                    <i class="fas fa-tag me-2"></i>Token Price
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 col-md-6">
                                                                <p class="fw-bold fs-5 mb-0 text-white">${{ @$property->userContract->tokenvalue }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($property->userContract->contract_address && $property->contract_link)
                                                <div class="col-12">
                                                    <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4 col-md-6">
                                                                    <p class="text-white fw-semibold mb-0">
                                                                        <i class="fas fa-link me-2"></i>Contract Address
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-8 col-md-6">
                                                                    <a href="{{ $property->contract_link }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                                                        <small class="text-break text-white">{{ $property->userContract->contract_address }}</small>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($property->yearOfConstruction)
                                                <div class="col-12">
                                                    <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-4 col-md-6">
                                                                    <p class="text-white fw-semibold mb-0">
                                                                        <i class="fas fa-building me-2"></i>Year of Build
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-8 col-md-6">
                                                                    <p class="fw-bold fs-5 mb-0 text-white">{{ $property->yearOfConstruction }}</p>
                                                                </div>
                                                            </div>
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
                </div>

                <div class="py-4">
                    <div class="container-fluid">
                        <!-- Property Overview -->
                        <div class="row">
                            <!-- Overview Section -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h2 class="card-title fw-bold">
                                        <i class="fas fa-info-circle me-2"></i>Overview
                                    </h2>
                                    <p class="text-muted">{{ @$property->propertyOverview }}</p>
                                </div>
                            </div>

                            @if($property->token_type == 2)
                                <!-- Highlights Section -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <h2 class="card-title fw-bold">
                                            <i class="fas fa-star me-2"></i>Highlights
                                        </h2>
                                        <p class="text-muted">{{ @$property->propertyHighlights }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Landmark Table -->
                            @if(!$property->propertyLandmark->isEmpty())
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <h2 class="card-title fw-bold">
                                            <i class="fas fa-map-pin me-2"></i>Landmarks
                                        </h2>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th><i class="fas fa-landmark me-2"></i>Landmark Name</th>
                                                        <th><i class="fas fa-route me-2"></i>Distance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($property->propertyLandmark[0]))
                                                        @foreach ($property->propertyLandmark as $landmark)
                                                            <tr>
                                                                <td>{{ @$landmark->landmarkName }}</td>
                                                                <td><span class="badge bg-info">{{ @$landmark->landmarkDist }} km</span></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="2" class="text-center text-muted">No landmarks available</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Connectivity -->
                            @if(@$property->propertyConnectivityOverview)
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <h2 class="card-title fw-bold">
                                            <i class="fas fa-wifi me-2"></i>Connectivity
                                        </h2>
                                        <p class="text-muted">{{ @$property->propertyConnectivityOverview }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Location Section -->
                            @if (!empty($property->propertyLocation))
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <h2 class="card-title fw-bold">
                                            <i class="fas fa-map-marker-alt me-2"></i>Location Details
                                        </h2>
                                        <h5 class="text-primary mb-3">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            {{ @$property->propertyLocation }}
                                        </h5>
                                        <p class="text-muted">{{ @$property->propertyLocationOverview }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Brochure -->
                            @if (!empty($property->brochure))
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h2 class="mb-0 fw-bold">
                                            <i class="fas fa-file-pdf me-2"></i>Brochure
                                        </h2>
                                        @if($property->brochure)
                                            <a href="{{ @img($property->brochure) }}" target="_blank" class="btn btn-outline-primary">
                                                <i class="far fa-file-pdf me-2"></i>View Brochure
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                                <!-- Property Details -->
                                @if($property->token_type == 1)
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-body row">
                                            <div class="col-md-6">
                                                <h2 class="fw-bold">
                                                    <i class="fas fa-home me-2"></i>Property Details
                                                </h2>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            @if($property->token_type == 2)
                                                                <tr><td><i class="fas fa-chart-pie me-2"></i>Total Deal Size</td><td>{{ @$property->totalDealSize }}</td></tr>
                                                                <tr><td><i class="fas fa-percentage me-2"></i>Expected Annual Return (%)</td><td>{{ @$property->expectedIrr }}</td></tr>
                                                                <tr><td><i class="fas fa-users me-2"></i>Funded Members</td><td>{{ @$property->fundedMembers }}</td></tr>
                                                                <tr><td><i class="fas fa-dollar-sign me-2"></i>Minimum Investment</td><td>{{ @$property->initialInvestment }}</td></tr>
                                                                <tr><td><i class="fas fa-calendar-alt me-2"></i>Minimum Holding Period</td><td>{{ @$property->holdingPeriod }}</td></tr>
                                                            @else
                                                                <tr><td><i class="fas fa-map-marker-alt me-2"></i>Location</td><td>{{ @$property->locality }}</td></tr>
                                                                <tr><td><i class="fas fa-building me-2"></i>Year of Build</td><td>{{ @$property->yearOfConstruction }}</td></tr>
                                                                <tr><td><i class="fas fa-layer-group me-2"></i>Community</td><td>{{ @$property->storeys }}</td></tr>
                                                                <tr><td><i class="fas fa-bed me-2"></i>Bedrooms</td><td>{{ @$property->propertyParking }}</td></tr>
                                                                <tr><td><i class="fas fa-bath me-2"></i>Bathrooms</td><td>{{ @$property->floorforSale }}</td></tr>
                                                                @if(@$property->propertyTotalBuildingArea)
                                                                    <tr><td><i class="fas fa-ruler-combined me-2"></i>Total Area</td><td>{{ @$property->propertyTotalBuildingArea }} sft</td></tr>
                                                                @endif
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                                                @if($property->token_type == 1 && $property->floorplan)
                                                    <h5 class="mb-3">
                                                        <i class="fas fa-drafting-compass me-2"></i>Floor Plan
                                                    </h5>
                                                    <a href="{{ @img($property->floorplan) }}" target="_blank" class="btn btn-outline-secondary">
                                                        <i class="far fa-file-pdf me-2"></i>View Floor Plan
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Documents Section -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        @php
                                            $documents = [
                                                'Prospectus' => $property->investor,
                                                'Report' => $property->titlereport,
                                                'Agreements' => $property->termsheet,
                                                'Share Certificate' => $property->propertyUpdatesDoc,
                                            ];
                                        @endphp

                                        @if (collect($documents)->filter()->isNotEmpty())
                                            <h2 class="fw-bold">
                                                <i class="fas fa-file-alt me-2"></i>Documents
                                            </h2>
                                            <div class="row text-center">
                                                @foreach ($documents as $label => $doc)
                                                    @if ($doc)
                                                        <div class="col-md-3 mb-4">
                                                            <div class="card h-100 border-0 shadow-sm">
                                                                <div class="card-body">
                                                                    <i class="far fa-file-pdf fa-3x text-danger mb-3"></i>
                                                                    <h6 class="card-title">{{ $label }}</h6>
                                                                    <a href="{{ @img($doc) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                                                        <i class="far fa-eye me-1"></i>View
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if($property->ManagementTeamDescription)
                                    <!-- Management Team Section -->
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h2 class="fw-bold">
                                                <i class="fas fa-users-cog me-2"></i>Management Team
                                            </h2>
                                            <p class="text-muted mb-4">{{ @$property->ManagementTeamDescription }}</p>
                                            <div class="row">
                                                @foreach(@$property->members as $member)
                                                    <div class="col-md-4 text-center mb-4">
                                                        <div class="card border-0 shadow-sm h-100">
                                                            <div class="card-body">
                                                                <img src="{{ img(@$member->memberPic) }}" class="img-fluid rounded-circle mb-3 border" style="width: 120px; height: 120px; object-fit: cover;">
                                                                <h5 class="card-title mb-1">{{ @$member->memberName }}</h5>
                                                                <p class="text-primary fw-bold mb-2">{{ @$member->memberPosition }}</p>
                                                                <p class="small text-muted">Short bio...<br><span class="text-muted">Full details about the team member here...</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
    </div>
@endsection

@section('scripts')
    <script>
        // Thumbnail click handler
        document.querySelectorAll('.img-thumbnail').forEach(function(thumb) {
            thumb.addEventListener('click', function () {
                const mainImg = document.getElementById('mainImage');
                mainImg.src = this.src;
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endsection
