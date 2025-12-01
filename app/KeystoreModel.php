<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Hash;

class KeystoreModel extends Model
{

    protected $table = 'keystore';
    protected $fillable = [
        'user_id',
        'title',
        'keystore_file_path',
        'encrypted_password',
        'public_address'
    ];

    public function setEncryptedPasswordAttribute($value)
    {
        $this->attributes['encrypted_password'] = Crypt::encryptString($value);
    }

    /**
     * Verifies if the given plain text password matches the decrypted stored password.
     *
     * @param string $plainPassword The plain text password to verify
     * @return bool True if the password matches, false otherwise
     */
    public function verifyPassword(string $plainPassword): bool
    {
        try {
            $decryptedPassword = Crypt::decryptString($this->encrypted_password);
            return $decryptedPassword === $plainPassword;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getPassward(): string
    {
        try {
            return Crypt::decryptString($this->encrypted_password);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getPrivateKey($get = 'private'){
        $password = $this->getPassward();
        $data = [
            "filename" => $this->keystore_file_path,
            "password" => $password,
        ];

        $result = callNodeOperations('read', $data);

        if (!isset($result['status']) || $result['status'] !== 'success') {
            $errorMessage = $result['message'] ?? 'Unable to read keystore.';
            throw new Exception("Failed to retrieve key(s). Reason: {$errorMessage}");
        }
        switch ($get) {
            case 'publicKey':
                return $this->public_address;

            case 'private':
                return $result['privatekey'];

            case 'both':
                return [
                    'publicKey' => $this->public_address,
                    'privatekey' => $result['privatekey'],
                ];

            default:
                throw new \Exception("Invalid key type requested: {$get}. Use 'public', 'private', or 'both'.");
        }
    }
}
