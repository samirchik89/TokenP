<?php

return [
    'production' => [
        'client_id' => env('PROD_PLAID_CLIENT_ID', ''),
        'secret' => env('PROD_PLAID_SECRET', ''),
    ],
    'sandbox' => [
        'client_id' => env('SANDBOX_PLAID_CLIENT_ID', ''),
        'secret' => env('SANDBOX_PLAID_SECRET', ''),
    ],
];
