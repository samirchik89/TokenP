<?php

namespace App\Services;

use App\KeystoreModel;
use App\User;
use App\UserIdentity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;
use Exception;

class CreateDemoUser
{
    private static $demoUserCount = 0;

    /**
     * Create a single demo user pair (investor and issuer)
     *
     * @return array
     * @throws Exception
     */
    public function createSingle()
    {
        try {
            DB::beginTransaction();

            $faker = Faker::create();
            $password = config('app.demo_password', 'password123');

            // Create Investor User
            $investor = $this->createUser($faker, User::USER_TYPE_INVESTOR, $password);

            // Create Issuer User
            $issuer = $this->createUser($faker, User::USER_TYPE_ISSUER, $password, $investor->id);

            // Create keystore for issuer
            $this->createKeystore($issuer->id);

            DB::commit();

            return [
                'issuer' => $issuer,
                'investor' => $investor
            ];

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create demo users: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create a user with the given parameters
     *
     * @param \Faker\Generator $faker
     * @param string $userType
     * @param string $password
     * @param int|null $investorId
     * @return User
     */
    private function createUser($faker, $userType, $password, $investorId = null)
    {
        // Generate email based on user type
        for ($i = 0; $i < 100; $i++) {

            if ($userType === User::USER_TYPE_ISSUER) {
                $email = "usethisfortestloginissuer" . (self::$demoUserCount > 1 ? self::$demoUserCount : "") . "@demo.com";
            } else {
                $email = "usethisfortestlogininvestor" . (self::$demoUserCount > 1 ? self::$demoUserCount : "") . "@demo.com";
            }

            $user = User::where('email', $email)->first();
            echo $email . "\n";
            if ($user) {
                self::$demoUserCount++;
                continue;
            } else {
                break;
            }
        }

        $userData = [
            'name' => $faker->firstName,
            'email' => $email,
            'password' => Hash::make($password),
            'user_type' => $userType,
            'verified' => 1,
            'approved' => 1,
            'property_tokens_created' => 0,
            'investments_made' => 0,
        ];

        if ($investorId) {
            $userData['investor_id'] = $investorId;
        }

        $user = User::create($userData);

        if (!$user) {
            throw new Exception("Failed to create user of type: {$userType}");
        }

        // Create UserIdentity record
        $this->createUserIdentity($user->id, $faker);

        return $user;
    }

    /**
     * Create user identity record
     *
     * @param int $userId
     * @param \Faker\Generator $faker
     * @return void
     * @throws Exception
     */
    private function createUserIdentity($userId, $faker)
    {
        $identityData = [
            'user_id' => $userId,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'dob' => $faker->date('Y-m-d', '-18 years'),
            'citizenship' => 'US',
            'residence' => 'US',
            'ssn_tax_id' => $faker->numerify('###-##-####'),
            'primary_phone' => $faker->numerify('1-###-###-####'),
            'primary_country_code' => '1',
            'address_line_1' => $faker->streetAddress,
            'city_id' => 1,
            'province' => $faker->state,
            'postal_code' => $faker->postcode,
            'country_code' => 'US'
        ];

        $identity = UserIdentity::create($identityData);

        if (!$identity) {
            throw new Exception("Failed to create user identity for user: {$userId}");
        }
    }

    /**
     * Create keystore for the given user
     *
     * @param int $userId
     * @return void
     * @throws Exception
     */
    private function createKeystore($userId)
    {
        $existingKeystore = KeystoreModel::first();

        if (!$existingKeystore) {
            throw new Exception('No keystore template found to replicate');
        }

        $keystore = $existingKeystore->replicate();
        $keystore->user_id = $userId;

        if (!$keystore->save()) {
            throw new Exception("Failed to create keystore for user: {$userId}");
        }
    }
}