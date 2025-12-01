<?php
namespace App\Enums;

class PaymentMethod
{
    const BANK_TRANSFER = 'bank_transfer';
    const CRYPTO_TRANSFER = 'crypto_transfer';

    public static function values()
    {
        return [
            self::BANK_TRANSFER,
            self::CRYPTO_TRANSFER,
        ];
    }

    public static function labels()
    {
        return [
            self::BANK_TRANSFER => 'Bank Transfer',
            self::CRYPTO_TRANSFER => 'Crypto Transaction',
        ];
    }
}
