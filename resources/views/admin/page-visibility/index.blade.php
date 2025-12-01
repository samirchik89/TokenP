@extends('admin.layout.base')

@section('title', 'Page Visibility Management')

@section('content')
<div class="content-area p-3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Page Visibility Settings</h4>
                        <p class="card-subtitle text-muted">Control which pages are visible to users</p>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.page-visibility.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                @foreach($items as $item)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group row">
                                            <label class="col-xs-2 col-form-label">
                                                <span>{{ $item['label'] }}</span>
                                            </label>
                                            <div class="col-xs-10">
                                                <div class="float-xs-left mr-1">
                                                    <input type="hidden" name="{{ $item['key'] }}" value="0">
                                                    <input
                                                        name="{{ $item['key'] }}"
                                                        type="checkbox"
                                                        class="js-switch"
                                                        data-color="#007bff"
                                                        value="1"
                                                        {{ $item['value'] ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save mr-2"></i>Update Visibility Settings
                                </button>
                                <a href="{{ route('admin.home') }}" class="btn btn-secondary ml-2">
                                    <i class="fa fa-arrow-left mr-2"></i>Back to Dashboard
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card-subtitle {
    margin-bottom: 0;
}

.form-group {
    margin-bottom: 1rem;
}

.col-form-label {
    padding-top: calc(0.375rem + 1px);
    margin-bottom: 0;
    font-size: inherit;
    line-height: 1.5;
}

.float-xs-left {
    float: left !important;
}

.mr-1 {
    margin-right: 0.25rem !important;
}
</style>
@endpush