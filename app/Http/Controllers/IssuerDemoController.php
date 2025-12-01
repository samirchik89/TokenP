<?php

namespace App\Http\Controllers;

use Auth;
use Crypt;
use Google2FA;
use App\Trade;
use App\User;
use App\Country;
use App\CountryCode;
use App\Document;
use App\Property;
use App\Bank;
use App\Coins;
use App\Admin;
use App\AssetType;
use App\UserToken;
use App\KycDocument;
use App\WithdrawEth;
use App\UserContract;
use App\UserIdentity;
use App\PropertyImage;
use App\DepositFiat;
use GuzzleHttp\Client;
use App\DepositHistory;
use App\PropertyUpdate;
use App\PropertyLandmark;
use App\WithdrawShare;
use App\ManagementMembers;
use App\IssuerTokenRequest;
use App\Mail\Withdrawalotp;
use App\PropertyComparable;
use App\UserCompanyDetails;
use App\InvestorWhitelist;
use Illuminate\Http\Request;
use App\UserTokenTransaction;
use App\AccreditedKycDocument;
use \ParagonIE\ConstantTime\Base32;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as AuthFacade;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommonController;
use App\KeystoreModel;
use App\BlockchainModel as Blockchain;
use App\InvestorShares;
use App\Notification;
use App\Services\TokenPaymentService;
use Illuminate\Support\Facades\DB;

class IssuerDemoController extends Controller {
    /**
     * Used to show Token
     */
    public function token()
    {
        $user = AuthFacade::user();
        if(!$user->canCreatePropertyToken()){
            return redirect()->route('platform.purchase');
        }
        $assetType = AssetType::orderBy('type', 'asc')->get();
        $coins = Coins::where('status', 1)->get();
        $keystores = KeystoreModel::where('user_id', $user->id)->get();
        $isKeystoreAvailable = $keystores->count() > 0;
        $blockchains = Blockchain::all();
        $isDemo = config('app.is_demo');
        // Generate dynamic mock data
        $mockData = $this->generateMockData();

        return view('issuer.token', compact('assetType','coins','keystores','isKeystoreAvailable','blockchains', 'mockData','isDemo'));
    }

    /**
     * Generate dynamic mock data for demo purposes
     */
    private function generateMockData()
    {
        $faker = \Faker\Factory::create();

        $propertyTypes = AssetType::all()->pluck('type')->toArray();
        $localities = ['Beverly Hills', 'Downtown LA', 'Santa Monica', 'Venice Beach', 'Hollywood', 'Pasadena'];
        $tokenSymbols = ['SVRT', 'DBC', 'RRC', 'HVC', 'MPR', 'ULS', 'TPC', 'GVE'];

        // Generate realistic property name using Faker
        $propertyName = $faker->randomElement([
            $faker->company . ' ' . $faker->randomElement(['Luxury Apartments', 'Residential Complex', 'Business Center', 'Commercial Plaza', 'Office Complex', 'Retail Center', 'Industrial Park', 'Mixed-Use Development']),
            $faker->randomElement(['Sunset', 'Riverside', 'Harbor View', 'Mountain Peak', 'Urban', 'Tech Park', 'Green Valley', 'Golden Gate', 'Ocean View', 'City Center']) . ' ' . $faker->randomElement(['Luxury Apartments', 'Residential Complex', 'Business Center', 'Commercial Plaza', 'Office Complex', 'Retail Center', 'Industrial Park', 'Mixed-Use Development']),
            $faker->randomElement(['The', 'Grand', 'Royal', 'Premier', 'Elite', 'Premium', 'Luxury', 'Executive']) . ' ' . $faker->randomElement(['Residences', 'Apartments', 'Suites', 'Towers', 'Plaza', 'Center', 'Complex', 'Gardens'])
        ]);

        $selectedType = $faker->randomElement($propertyTypes);
        $selectedLocality = $faker->randomElement($localities);

        // Generate token name first
        $tokenName = $faker->randomElement([
            $faker->randomElement(['Sunset', 'Riverside', 'Harbor', 'Mountain', 'Urban', 'Tech', 'Green', 'Golden', 'Ocean', 'City']) . ' Token',
            $faker->randomElement(['LA', 'CA', 'West', 'East', 'North', 'South']) . ' ' . $faker->randomElement(['Real Estate', 'Property', 'Asset']) . ' Token',
            $faker->randomElement(['Premium', 'Luxury', 'Elite', 'Royal', 'Grand']) . ' ' . $faker->randomElement(['Property', 'Asset', 'Real Estate']) . ' Token'
        ]);

        // Generate token symbol from first letter of token name + suffix
        $firstLetter = strtoupper(substr($tokenName, 0, 1));
        $suffixes = ['RT', 'TK', 'PT', 'AT', 'ET', 'ST', 'LT', 'CT'];
        $selectedSymbol = $firstLetter . $faker->randomElement($suffixes);

        // Generate random financial data
        $dealSize = $faker->numberBetween(1000000, 10000000);
        $tokenValue = $faker->numberBetween(50, 500);
        $tokenSupply = intval($dealSize / $tokenValue);
        $expectedIrr = $faker->randomFloat(1, 5, 15);
        $initialInvestment = 1;//$faker->numberBetween(1000, 10000);
        $totalSqft = $faker->numberBetween(10000, 100000);

        // Generate realistic address
        $streetNumber = $faker->numberBetween(1000, 9999);
        $streetName = $faker->randomElement(['Sunset Boulevard', 'Wilshire Boulevard', 'Santa Monica Boulevard', 'Hollywood Boulevard', 'Ventura Boulevard', 'Pacific Coast Highway', 'Sepulveda Boulevard', 'La Cienega Boulevard']);
        $zipCode = $faker->numberBetween(90000, 99999);

        return [
            'propertyName' => $propertyName,
            'propertyType' => $selectedType,
            'propertyLocation' => $streetNumber . ' ' . $streetName . ', ' . $selectedLocality . ', CA ' . $zipCode,
            'expectedIrr' => $expectedIrr,
            'holdingPeriod' => $faker->randomElement([ '< 1', '2', '5', '> 5']),
            'initialInvestment' => $initialInvestment,
            'areaType' => 'Sq ft',
            'tokenValue' => $tokenValue,
            'totalDealSize' => $dealSize,
            'totalSqft' => $totalSqft,
            'showProperty' => 'yes',
            'locality' => $selectedLocality,
            'yearOfConstruction' => $faker->numberBetween(2015, 2023),
            'propertyDetailsHighlights' => 'Modern ' . strtolower($selectedType) . ' development featuring state-of-the-art amenities, 24/7 security, and premium finishes. Located in prime ' . $selectedLocality . ' area with excellent connectivity to major attractions and business districts. ' . $faker->sentence(),
            'propertyOverview' => $propertyName . ' is a premium ' . strtolower($selectedType) . ' development offering luxury units with modern amenities including smart home technology, fitness center, and stunning views. Built with sustainable materials and energy-efficient systems. ' . $faker->paragraph(),
            'propertyLocationOverview' => 'Located in the prestigious ' . $selectedLocality . ' area, the property offers excellent connectivity to major highways, shopping districts, and cultural attractions. The area is known for its high-end market and strong appreciation potential. ' . $faker->sentence(),
            'tokenName' => $tokenName,
            'tokenSymbol' => $selectedSymbol,
            'tokenDecimal' => 18,
            'tokenSupply' => $tokenSupply,
            'managementTeamDescription' => 'Our experienced management team brings over ' . $faker->numberBetween(20, 30) . ' years of combined experience in real estate development, property management, and investment management. Led by industry veterans with proven track records in luxury developments and successful exits. ' . $faker->paragraph(),
            'airport' => 'LAX International Airport - ' . $faker->numberBetween(5, 25) . ' miles',
            'hospitals' => $faker->randomElement(['Cedars-Sinai Medical Center', 'UCLA Medical Center', 'USC Medical Center', 'Kaiser Permanente']) . ' - ' . $faker->numberBetween(2, 15) . ' miles',
            'fireServices' => 'Los Angeles Fire Department - ' . $faker->numberBetween(1, 10) . ' miles',
            'industrial' => $faker->randomElement(['Downtown Industrial District', 'Commerce Industrial Park', 'Vernon Industrial Area', 'City of Industry']) . ' - ' . $faker->numberBetween(3, 20) . ' miles'
        ];
    }
}
