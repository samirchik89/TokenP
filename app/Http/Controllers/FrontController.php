<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Property;
use App\PropertyImage;
use App\User; // Added this import for the new propertyDetail method
use Illuminate\Support\Facades\Auth; // Added this import for the new purchase method

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function marketplace()
    {
        try {
            // Fetch active properties with their related data
            $properties = Property::with(['propertyImages', 'userContract', 'blockchain'])
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->get();

            // Calculate additional data for each property
            foreach ($properties as $property) {
                // Calculate sold percentage
                if (!empty($property->userContract)) {
                    $remainingTokens = round(($property->userContract->tokensupply - $property->userContract->tokenbalance));
                    $property->sold_percentage = $property->userContract->tokensupply > 0 ?
                        round(($remainingTokens / $property->userContract->tokensupply) * 100, 2) : 0;
                    $property->accuired_usd = $property->userContract->tokenvalue * $remainingTokens;

                    // Add contract details
                    if (!empty($property->blockchain)) {
                        $property->contract_address = $property->userContract->contract_address;
                        $url = $property->blockchain->link;
                        $property->contract_link = $url . 'token/' . $property->contract_address;
                        $property->coin = $property->blockchain->blockchain_name;
                    }
                } else {
                    $property->sold_percentage = 0;
                    $property->accuired_usd = 0;
                }

                // Get first image for display
                $property->main_image = $property->propertyImages->first();
            }

            return view('front.marketplace', compact('properties'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load marketplace. Please try again later.');
        }
    }

    public function submitContactForm(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please check your input and try again.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Prepare contact data
            $contactData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'message' => $request->input('message')
            ];

            // Send email to admin/support
            Mail::to('support@tokeneasy.io')->send(new ContactMail($contactData));
            // Mail::to('samirchik89@gmail.com')->send(new ContactMail($contactData));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.'
            ], 500);
        }
    }

    public function propertyDetail($id)
    {
        try {
            // Fetch property with all related data
            $property = Property::with([
                'propertyImages',
                'userContract',
                'blockchain',
                // 'propertyBulider',
                'propertyComparable',
                'propertyLandmark',
                'members',
                'updates'
            ])->where('id', $id)
              ->where('status', 'active')
              ->first();

            if (!$property) {
                return redirect()->route('marketplace')->with('error', 'Property not found or not available.');
            }

            // Calculate investment metrics
            if (!empty($property->userContract)) {
                $remainingTokens = round(($property->userContract->tokensupply - $property->userContract->tokenbalance));
                $property->sold_percentage = $property->userContract->tokensupply > 0 ?
                    round(($remainingTokens / $property->userContract->tokensupply) * 100, 2) : 0;
                $property->accuired_usd = $property->userContract->tokenvalue * $remainingTokens;

                // Add contract details
                if (!empty($property->blockchain)) {
                    $property->contract_address = $property->userContract->contract_address;
                    $url = $property->blockchain->link;
                    $property->contract_link = $url . 'token/' . $property->contract_address;
                    $property->coin = $property->blockchain->blockchain_name;
                }
            } else {
                $property->sold_percentage = 0;
                $property->accuired_usd = 0;
            }

            // Get all property images
            $property->all_images = $property->propertyImages;
            $property->main_image = $property->propertyImages->first();

            // Get issuer details
            $issuer = User::find($property->user_id);
            $property->issuer = $issuer;

            // Get related properties (same issuer or similar type)
            $relatedProperties = Property::with(['propertyImages', 'userContract', 'blockchain'])
                ->where('id', '!=', $property->id)
                ->where('status', 'active')
                ->where(function($query) use ($property) {
                    $query->where('user_id', $property->user_id)
                          ->orWhere('propertyType', $property->propertyType)
                          ->orWhere('locality', $property->locality);
                })
                ->limit(3)
                ->get();

            // Calculate metrics for related properties
            foreach ($relatedProperties as $relatedProperty) {
                if (!empty($relatedProperty->userContract)) {
                    $remainingTokens = round(($relatedProperty->userContract->tokensupply - $relatedProperty->userContract->tokenbalance));
                    $relatedProperty->sold_percentage = $relatedProperty->userContract->tokensupply > 0 ?
                        round(($remainingTokens / $relatedProperty->userContract->tokensupply) * 100, 2) : 0;
                    $relatedProperty->accuired_usd = $relatedProperty->userContract->tokenvalue * $remainingTokens;

                    if (!empty($relatedProperty->blockchain)) {
                        $relatedProperty->contract_address = $relatedProperty->userContract->contract_address;
                        $url = $relatedProperty->blockchain->link;
                        $relatedProperty->contract_link = $url . 'token/' . $relatedProperty->contract_address;
                        $relatedProperty->coin = $relatedProperty->blockchain->blockchain_name;
                    }
                } else {
                    $relatedProperty->sold_percentage = 0;
                    $relatedProperty->accuired_usd = 0;
                }

                $relatedProperty->main_image = $relatedProperty->propertyImages->first();
            }

            return view('front.property-detail', compact('property', 'relatedProperties'));

        } catch (\Exception $e) {
            return redirect()->route('marketplace')->with('error', 'Unable to load property details. Please try again later.');
        }
    }

    public function purchase($id)
    {
        try {
            // Check if property exists and is active
            $property = Property::where('id', $id)
                ->where('status', 'active')
                ->first();

            if (!$property) {
                return redirect()->route('marketplace')->with('error', 'Property not found or not available for investment.');
            }

            // Check if user is authenticated
            if (!Auth::check()) {
                // Store the intended destination in session
                session(['intended_url' => route('applyInvest', $id)]);
                return redirect()->route('investor.login')->with('info', 'Please login as an investor to invest in this property.');
            }

            // Check if user is an investor
            if (Auth::user()->user_type != 1) {
                Auth::logout();
                // Store the intended destination in session
                session(['intended_url' => route('applyInvest', $id)]);
                return redirect()->route('investor.login')->with('error', 'Only investors can purchase properties. Please login with an investor account.');
            }

            // Check if user has completed KYC (required for applyInvest)
            // if (!Auth::user()->kyc_status || Auth::user()->kyc_status !== 'approved') {
            //     return redirect()->route('kyc')->with('error', 'Please complete your KYC verification before investing.');
            // }

            // Redirect to the applyInvest route
            return redirect()->route('applyInvest', $id);

        } catch (\Exception $e) {
            return redirect()->route('marketplace')->with('error', 'Unable to process purchase request. Please try again later.');
        }
    }

    public function platformPurchase()
    {
        // Define platform plans
        $plans = [
            [
                'name' => 'Starter',
                'type' => 'starter',
                'price' => 99,
                'duration' => 'monthly',
                'features' => [
                    'Up to 5 properties',
                    'Basic tokenization',
                    'Email support',
                    'Standard templates',
                    'Basic analytics'
                ],
                'popular' => false
            ],
            [
                'name' => 'Professional',
                'type' => 'professional',
                'price' => 299,
                'duration' => 'monthly',
                'features' => [
                    'Up to 25 properties',
                    'Advanced tokenization',
                    'Priority support',
                    'Custom templates',
                    'Advanced analytics',
                    'White-label options',
                    'API access'
                ],
                'popular' => true
            ],
            [
                'name' => 'Enterprise',
                'type' => 'enterprise',
                'price' => 999,
                'duration' => 'monthly',
                'features' => [
                    'Unlimited properties',
                    'Full tokenization suite',
                    '24/7 dedicated support',
                    'Custom development',
                    'Advanced analytics & reporting',
                    'Full white-label solution',
                    'Full API access',
                    'Custom integrations',
                    'Dedicated account manager'
                ],
                'popular' => false
            ]
        ];

        return view('front.platform-purchase', compact('plans'));
    }

    public function pricing()
    {
        return view('front.pricing');
    }
}