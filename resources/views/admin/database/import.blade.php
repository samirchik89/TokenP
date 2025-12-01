@extends('admin.layout.base')

@section('title', 'Import Database')

@section('content')
<div class="content-area p-y-3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa fa-database me-2"></i>Database Management
                        </h4>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                            </div>
                        @endif

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <i class="fa fa-exclamation-triangle me-2"></i>
                            <strong>Warning!</strong> Importing a database will overwrite existing data. Please make sure to backup your current database before proceeding.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fa fa-upload me-2"></i>Import Database
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.database.import.upload') }}" method="POST" enctype="multipart/form-data" id="importForm">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="sql_file" class="form-label fw-bold">Select SQL File</label>
                                                <input type="file" class="form-control" id="sql_file" name="sql_file" accept=".sql" required>
                                                <small class="text-muted">
                                                    <i class="fa fa-info-circle me-2"></i>Maximum file size: 10MB
                                                </small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="truncate_first" id="truncate_first">
                                                    <label class="form-check-label" for="truncate_first">
                                                        <strong>Clear database before import</strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fa fa-exclamation-triangle me-2"></i>
                                                            This will delete ALL existing data before importing. Use with caution!
                                                        </small>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="disable_constraints" id="disable_constraints" checked>
                                                    <label class="form-check-label" for="truncate_first">
                                                        <strong>Disable foreign key constraints during import</strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fa fa-info-circle me-2"></i>
                                                            This prevents constraint errors and allows importing data in any order.
                                                        </small>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-0">
                                                <button type="submit" class="btn btn-primary btn-lg" onclick="return confirmImport(event)">
                                                    <i class="fa fa-upload me-2"></i>Import Database
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <i class="fa fa-download me-2"></i>Export Database
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.database.export') }}" method="POST" id="exportForm">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Export Options</label>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="include_data" id="include_data" checked>
                                                    <label class="form-check-label" for="include_data"> Include Data</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="include_structure" id="include_structure" checked>
                                                    <label class="form-check-label" for="include_structure"> Include Structure</label>
                                                </div>
                                            </div>

                                            <div class="mb-0">
                                                <button type="submit" class="btn btn-success btn-lg">
                                                    <i class="fa fa-download me-2"></i>Export Database
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmImport(event) {
    event.preventDefault();

    var truncateFirst = document.getElementById('truncate_first').checked;
    var title = truncateFirst ? '⚠️ DANGER: Clear Database First!' : 'Are you sure?';
    var text = truncateFirst
        ? "This will DELETE ALL EXISTING DATA and then import the new database. This action cannot be undone!"
        : "This will overwrite your current database! Make sure you have a backup.";
    var icon = truncateFirst ? 'error' : 'warning';
    var confirmButtonText = truncateFirst ? 'Yes, DELETE ALL DATA and import!' : 'Yes, import it!';
    var confirmButtonColor = truncateFirst ? '#d33' : '#3085d6';

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: confirmButtonColor,
        cancelButtonColor: '#6c757d',
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('importForm').submit();
        }
    });

    return false;
}

// File input change handler for Bootstrap 5
document.querySelector('#sql_file').addEventListener('change', function(e) {
    var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file...';
    // Bootstrap 5 handles file input display automatically
});
</script>
@endpush
@endsection