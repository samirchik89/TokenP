<?php

namespace App\Http\Middleware;

use Closure;
use App\AccreditedKycDocument;
use App\Document;

class CheckUserKyc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {
            $proofs = Document::where('mandatory', '1')->pluck('id')->toArray();
            // dd($proofs, AccreditedKycDocument::where('user_id', auth()->id())->whereIn('accredited_document_id', $proofs)->where('status', 'APPROVED')->get());
            if (auth()->user()->approved == 0) {
                return auth()->user()->user_type == 1 ? redirect('/profile')->with('flash_error', 'Your account is not approved yet!') : redirect('issuer/profile')->with('flash_error', 'Your account is not approved yet!');
            }
            if (setting('kyc_approval') == 1 && AccreditedKycDocument::where('user_id', auth()->id())->whereIn('accredited_document_id', $proofs)->count() < count($proofs)) {
                return auth()->user()->user_type == 1 ? redirect('/profile')->with('flash_error', 'Please upload mandatory documents to verify your KYC!') : redirect('issuer/profile')->with('flash_error', 'Please upload mandatory documents to verify your KYC!');
            }
            if (setting('kyc_approval') == 1 && AccreditedKycDocument::where('user_id', auth()->id())->whereIn('accredited_document_id', $proofs)->where('status', '!=', 'APPROVED')->first()) {
                return auth()->user()->user_type == 1 ? redirect('/profile')->with('flash_error', 'Your KYC is not approved yet!') : redirect('issuer/profile')->with('flash_error', 'Your KYC is not approved yet!');
            }
        }
        return $next($request);
    }
}
