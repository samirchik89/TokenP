<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DemoUserAutoFillService
{
    /**
     * Get demo user credentials based on IP address
     *
     * @param Request $request
     * @param string $userType
     * @return array|null
     */
    public function getDemoUserCredentials(Request $request, $userType = User::USER_TYPE_INVESTOR)
    {
        // Only work in demo mode
        if (!config('app.is_demo', false)) {
            return null;
        }

        // Validate user type
        if (!in_array($userType, [User::USER_TYPE_INVESTOR, User::USER_TYPE_ISSUER])) {
            Log::warning('Invalid user type provided to DemoUserAutoFillService', ['userType' => $userType]);
            return null;
        }

        $clientIp = $this->getClientIp($request);
        $user = null;

        // First, check if there's already a user assigned to this IP
        $userByIp = User::where('approved', 1)
            ->where('verified', 1)
            ->where('ip_address', $clientIp)
            ->first();

        if ($userByIp) {
            if ($userByIp->user_type == $userType) {
                $user = $userByIp;
            } else {
                // Find the related user of the requested type
                $user = $this->findRelatedUser($userByIp, $userType);
            }
        }

        // If no user found by IP, look for an available user with null ip_address
        if (!$user) {
            $excludedUserIds = config('app.demo_excluded_user_ids', [12, 13]);

            $user = User::where('verified', 1)
                ->where('approved', 1)
                ->where('user_type', $userType)
                // ->whereNull('ip_address')
                ->whereNotIn('id', $excludedUserIds)
                ->first();
        }

        // Check if user exists before proceeding
        if (!$user) {
            Log::info('No available demo user found', [
                'userType' => $userType,
                'clientIp' => $clientIp
            ]);
            return null;
        }

        try {
            // Set IP address for related user of different type
            $this->setOtherUserType($user, $clientIp);

            // Update the user's IP address to prevent future matches
            $user->update(['ip_address' => $clientIp]);

            // Get the password from config
            $password = config('app.demo_password', 'password123');

            Log::info('Demo user assigned successfully', [
                'userId' => $user->id,
                'userType' => $user->user_type,
                'clientIp' => $clientIp
            ]);

            return [
                'email' => $user->email,
                'password' => $password,
            ];
        } catch (\Exception $e) {
            Log::error('Error assigning demo user', [
                'userId' => $user->id,
                'clientIp' => $clientIp,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Find related user of different type
     *
     * @param User $user
     * @param string $targetUserType
     * @return User|null
     */
    private function findRelatedUser(User $user, $targetUserType)
    {
        if ($user->user_type == User::USER_TYPE_INVESTOR) {
            // If current user is investor, find related issuer
            return User::where('user_type', User::USER_TYPE_ISSUER)
                ->where('investor_id', $user->id)
                ->where('approved', 1)
                ->where('verified', 1)
                ->first();
        } else {
            // If current user is issuer, find related investor
            return User::where('user_type', User::USER_TYPE_INVESTOR)
                ->where('id', $user->investor_id)
                ->where('approved', 1)
                ->where('verified', 1)
                ->first();
        }
    }

    /**
     * Set IP address for related user of different type
     *
     * @param User $user
     * @param string $ipAddress
     * @return void
     */
    public function setOtherUserType($user, $ipAddress)
    {
        $otherUser = $this->findRelatedUser($user, $user->user_type == User::USER_TYPE_INVESTOR ? User::USER_TYPE_ISSUER : User::USER_TYPE_INVESTOR);

        // Only update if other user exists and doesn't already have an IP address
        if ($otherUser && is_null($otherUser->ip_address)) {
            $otherUser->update(['ip_address' => $ipAddress]);

            Log::info('Related user IP address updated', [
                'userId' => $otherUser->id,
                'userType' => $otherUser->user_type,
                'ipAddress' => $ipAddress
            ]);
        }
    }

    /**
     * Get client IP address with validation
     *
     * @param Request $request
     * @return string
     */
    private function getClientIp(Request $request)
    {
        // Check for forwarded IP first (for proxies/load balancers)
        $forwardedIp = $request->header('X-Forwarded-For');
        if ($forwardedIp && $this->isValidIp($forwardedIp)) {
            return $forwardedIp;
        }

        $realIp = $request->header('X-Real-IP');
        if ($realIp && $this->isValidIp($realIp)) {
            return $realIp;
        }

        // Fallback to direct IP
        return $request->ip();
    }

    /**
     * Validate IP address format
     *
     * @param string $ip
     * @return bool
     */
    private function isValidIp($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }

    /**
     * Reset IP addresses for demo users (for testing purposes)
     *
     * @return bool
     */
    public function resetDemoUserIpAddresses()
    {
        if (!config('app.is_demo', false)) {
            return false;
        }

        try {
            // Reset IP addresses for demo users
            $updatedCount = User::where('verified', 1)
                ->where('approved', 1)
                ->whereNotNull('ip_address')
                ->update(['ip_address' => null]);

            Log::info('Demo user IP addresses reset', ['updatedCount' => $updatedCount]);
            return true;
        } catch (\Exception $e) {
            Log::error('Error resetting demo user IP addresses', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get available demo users count
     *
     * @return array
     */
    public function getAvailableDemoUsersCount()
    {
        if (!config('app.is_demo', false)) {
            return ['investors' => 0, 'issuers' => 0];
        }

        try {
            $excludedUserIds = config('app.demo_excluded_user_ids', [12, 13]);

            $investors = User::whereNull('ip_address')
                ->where('user_type', User::USER_TYPE_INVESTOR)
                ->where('verified', 1)
                ->where('approved', 1)
                ->whereNotIn('id', $excludedUserIds)
                ->count();

            $issuers = User::whereNull('ip_address')
                ->where('user_type', User::USER_TYPE_ISSUER)
                ->where('verified', 1)
                ->where('approved', 1)
                ->whereNotIn('id', $excludedUserIds)
                ->count();

            return [
                'investors' => $investors,
                'issuers' => $issuers
            ];
        } catch (\Exception $e) {
            Log::error('Error getting available demo users count', ['error' => $e->getMessage()]);
            return ['investors' => 0, 'issuers' => 0];
        }
    }
}