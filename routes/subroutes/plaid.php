<?php

use App\Http\Controllers\Payment\PlaidController;
use App\Http\Controllers\Payment\PlaidWebHookController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Plaid API Routes
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => 'plaid'
// , 'middleware' => ['auth']

], function () {

    Route::get('/index', [PlaidController::class, 'index'])->name('plaid.index');
    Route::get('/connect', [PlaidController::class, 'connect'])->name('plaid.connect');

    Route::get('/account-details/{itemId}', [PlaidController::class, 'accountDetails'])->name('plaid.account-details');
    Route::get('/remove-item/{itemId}', [PlaidController::class, 'removeItem'])->name('plaid.remove-item');
    // Link token creation
    Route::post('/create-link-token', [PlaidController::class, 'createLinkToken']);

    // Token exchange
    Route::post('/exchange-token', [PlaidController::class, 'exchangeToken']);

    // Account operations
    Route::get('/items', [PlaidController::class, 'listItems']);
    Route::get('/items/{itemId}', [PlaidController::class, 'getItem']);
    Route::get('/items/{itemId}/accounts', [PlaidController::class, 'getAccounts']);
    Route::delete('/items/{itemId}', [PlaidController::class, 'removeItem']);

    // // Transactions
    Route::get('/items/{itemId}/transactions', [PlaidController::class, 'getTransactions']);
    Route::post('/items/{itemId}/sync-transactions', [PlaidController::class, 'syncTransactions']);

    // // Auth and Identity
    Route::get('/items/{itemId}/auth', [PlaidController::class, 'getAuth']);
    Route::get('/items/{itemId}/identity', [PlaidController::class, 'getIdentity']);

    Route::get('/test-transfer', [PlaidController::class, 'makeTestTransfer']);
});

// Public webhook endpoint (no authentication required)
Route::post('/plaid/webhook', [PlaidWebHookController::class, 'handleWebhook'])->name('plaid.webhook');
Route::get('/plaid/simulate-transfer-event', [PlaidController::class, 'simulateTransferEvent']);
Route::get('/plaid/sync-transfer-events', [PlaidController::class, 'syncTransferEvents']);