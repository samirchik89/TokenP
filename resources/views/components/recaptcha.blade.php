@php
    $siteKey = config('recaptcha.site_key');
@endphp
@if(!empty($siteKey))
<div class="mt-3">
    <div class="g-recaptcha" data-sitekey="{{ $siteKey }}"></div>
    @if (isset($errors) && $errors->has('g-recaptcha-response'))
        <span class="text-danger" role="alert">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
        </span>
    @endif
</div>
@endif
