@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




@if(Session::has('flash_error'))
<div class="alert alert-danger alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
    <strong>Error!</strong> {{ Session::get('flash_error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
</div>
@endif


@if(Session::has('flash_success'))
<div class="alert alert-success alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
    <strong>Success!</strong>{{ Session::get('flash_success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
</div>
@endif
@if(Session::has('flash_warning'))
<div class="alert alert-alert alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
    <strong>Welcome!</strong> {{ Session::get('flash_warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
</div>
@endif

