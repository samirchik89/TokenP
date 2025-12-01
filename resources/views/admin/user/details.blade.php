@extends('admin.layout.base')

@section('title', 'User Details')

@section('content')
<div class="content-area py-4">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">User Details</h4>
               
            </div>
            
            <div class="card-body">
                <!-- Basic User Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">First Name</label>
                            <div class="info-value">{{ @$user->identity->first_name ?: 'Not provided' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">Last Name</label>
                            <div class="info-value">{{ @$user->identity->last_name ?: 'Not provided' }}</div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">Email</label>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">User Type</label>
                            <div class="info-value">
                                @if ($user->user_type == 1 || $user->user_type == 'individual')
                                    <span class="badge bg-primary">Individual User</span>
                                @elseif ($user->user_type == 2 || $user->user_type == 'company')
                                    <span class="badge bg-success">Company User</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Individual User Details -->
                @if ($user->user_type == 1 || $user->user_type == 'individual')
                    <div class="section-divider">
                        <h5 class="section-title">Personal Information</h5>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="info-item">
                                <label class="info-label">Date of Birth</label>
                                <div class="info-value">
                                    {{ @$user->identity->dob ? date('d M Y', strtotime($user->identity->dob)) : 'Not provided' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <label class="info-label">Citizenship</label>
                                <div class="info-value">{{ $user->identity->citizenship ?? 'Not provided' }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <label class="info-label">Residence</label>
                                <div class="info-value">{{ $user->identity->residence ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Primary Phone</label>
                                <div class="info-value">{{ $user->identity->primary_phone ?? 'Not provided' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Secondary Phone</label>
                                <div class="info-value">{{ $user->identity->secondary_phone ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Section -->
                    <div class="section-divider">
                        <h5 class="section-title">Documents</h5>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="document-item">
                                <label class="info-label">Document Proof</label>
                                <div class="document-preview">
                                    @if (isset($user->identity->document))
                                        <img src="{{ img($user->identity->document) }}" 
                                             class="document-image" 
                                             alt="Document Proof"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#documentModal"
                                             onclick="showImage('{{ img($user->identity->document) }}', 'Document Proof')">
                                    @else
                                        <div class="no-document">No document uploaded</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="document-item">
                                <label class="info-label">Photo Proof</label>
                                <div class="document-preview">
                                    @if (isset($user->identity->photo))
                                        <img src="{{ img($user->identity->photo) }}" 
                                             class="document-image" 
                                             alt="Photo Proof"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#documentModal"
                                             onclick="showImage('{{ img($user->identity->photo) }}', 'Photo Proof')">
                                    @else
                                        <div class="no-document">No photo uploaded</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

               <!-- Company User Details -->
                @if ($user->user_type == 2 || $user->user_type == 'company')
                <div class="section-divider">
                    <h5 class="section-title">Company Information</h5>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">Company Name</label>
                            <div class="info-value">{{ $user_detail_company->company_name ?? 'Not provided' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">Headquarters</label>
                            <div class="info-value">{{ $user_detail_company->headquarters ?? 'Not provided' }}</div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="info-item">
                            <label class="info-label">Date Founded</label>
                            <div class="info-value">
                                {{ isset($user_detail_company->date_founded) ? date('d M Y', strtotime($user_detail_company->date_founded)) : 'Not provided' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-item">
                            <label class="info-label">Team Size</label>
                            <div class="info-value">{{ $user_detail_company->team_size ?? 'Not provided' }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-item">
                            <label class="info-label">Company URL</label>
                            <div class="info-value">
                                @if (isset($user_detail_company->company_url))
                                    <a href="{{ $user_detail_company->company_url }}" target="_blank" class="text-primary">
                                        {{ $user_detail_company->company_url }}
                                    </a>
                                @else
                                    Not provided
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="info-label">Social Channels</label>
                            <div class="info-value">{{ $user_detail_company->social_channels ?? 'Not provided' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Empty column for consistent alignment -->
                    </div>
                </div>

                <!-- Company Documents Section -->
                <div class="section-divider">
                    <h5 class="section-title">Company Documents</h5>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="document-item">
                            <label class="info-label">Incorporation Certificate</label>
                            <div class="document-preview">
                                @if (isset($user_detail_company->incorporation_certificate))
                                    <img src="{{ img($user_detail_company->incorporation_certificate) }}" 
                                        class="document-image" 
                                        alt="Incorporation Certificate"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#documentModal"
                                        onclick="showImage('{{ img($user_detail_company->incorporation_certificate) }}', 'Incorporation Certificate')">
                                @else
                                    <div class="no-document">No document uploaded</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="document-item">
                            <label class="info-label">Partnership Deed</label>
                            <div class="document-preview">
                                @if (isset($user_detail_company->partnership_deed))
                                    <img src="{{ img($user_detail_company->partnership_deed) }}" 
                                        class="document-image" 
                                        alt="Partnership Deed"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#documentModal"
                                        onclick="showImage('{{ img($user_detail_company->partnership_deed) }}', 'Partnership Deed')">
                                @else
                                    <div class="no-document">No document uploaded</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="document-item">
                            <label class="info-label">Trust Deed</label>
                            <div class="document-preview">
                                @if (isset($user_detail_company->trust_deed))
                                    <img src="{{ img($user_detail_company->trust_deed) }}" 
                                        class="document-image" 
                                        alt="Trust Deed"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#documentModal"
                                        onclick="showImage('{{ img($user_detail_company->trust_deed) }}', 'Trust Deed')">
                                @else
                                    <div class="no-document">No document uploaded</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="document-item">
                            <label class="info-label">Registered Societies</label>
                            <div class="document-preview">
                                @if (isset($user_detail_company->register_socities))
                                    <img src="{{ img($user_detail_company->register_socities) }}" 
                                        class="document-image" 
                                        alt="Registered Societies"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#documentModal"
                                        onclick="showImage('{{ img($user_detail_company->register_socities) }}', 'Registered Societies')">
                                @else
                                    <div class="no-document">No document uploaded</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="document-item">
                            <label class="info-label">Signing Authority</label>
                            <div class="document-preview">
                                @if (isset($user_detail_company->signing_authority))
                                    <img src="{{ img($user_detail_company->signing_authority) }}" 
                                        class="document-image" 
                                        alt="Signing Authority"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#documentModal"
                                        onclick="showImage('{{ img($user_detail_company->signing_authority) }}', 'Signing Authority')">
                                @else
                                    <div class="no-document">No document uploaded</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Document Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Document">
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    margin-bottom: 1.5rem;
}

.info-label {
    font-weight: 600;
    color: #6c757d;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
    display: block;
}

.info-value {
    font-size: 1rem;
    color: #212529;
    font-weight: 500;
}

.section-divider {
    margin: 2rem 0 1.5rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.section-title {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0;
}

.document-item {
    margin-bottom: 1.5rem;
}

.document-preview {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.document-preview:hover {
    border-color: #007bff;
    background-color: #e7f3ff;
}

.document-image {
    max-width: 100%;
    max-height: 150px;
    border-radius: 4px;
    cursor: pointer;
    transition: transform 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.document-image:hover {
    transform: scale(1.05);
}

.no-document {
    color: #6c757d;
    font-style: italic;
    padding: 2rem;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    border-radius: 12px 12px 0 0 !important;
    padding: 1.5rem;
}

.card-body {
    padding: 2rem;
}

.badge {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .section-divider {
        margin: 1.5rem 0 1rem 0;
    }
    
    .document-image {
        max-height: 120px;
    }
}
</style>

<script>
    function showImage(src, title) {
        document.getElementById('modalImage').src = src;
        document.getElementById('documentModalLabel').textContent = title;
    }
</script>
@endsection
