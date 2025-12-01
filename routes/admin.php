<?php
use App\Http\Controllers\Admin\PageVisibilityController;

use App\Http\Controllers\Admin\DatabaseController;

Route::get('/home', 'AdminController@dashboard')->name('home');
Route::get('/earnings', 'AdminController@Earnings')->name('earnings');
Route::get('/user_wallet/{type}', 'AdminController@UserWallet')->name('wallets');
Route::get('/user_deposit_history/{type}', 'AdminController@UserDepositHistory')->name('deposit.history');

Route::resource('user', 'Resource\UserResource');
Route::get('/users/{type}', 'Resource\UserResource@index');
Route::get('user/{id}/kycdoc', 'AdminController@kycdoc')->name('user.kycdoc');
Route::get('user/{id}/{status}', 'AdminController@userStatus')->name('user.userStatus');
Route::get('userapproval/{id}/{status}', 'AdminController@userApprovalStatus')->name('user.userApprovalStatus');
Route::get('{id}/details', 'Resource\UserResource@details')->name('details');



//Google 2 factor
Route::get('/Google2fa', function () {
	if(isset($_GET['google_succ'])){
        if($_GET['google_succ']==1){
          \Session::flash('flash_success',"Google two factor authentication enabled successfully...");
        }
  	}
	return view('admin.2fa.google2factor');
});

Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::post('/g2fotpcheckenable', 'Google2FAController@g2fotpcheckenable');

Route::get('/2fa/urlform', 'AdminController@getValidateToken');
Route::post('/2fa/urlvalidate', ['middleware' => 'throttle:5', 'uses' => 'AdminController@postValidateToken']);




Route::get('user/{id}/history', 'AdminController@transhistory')->name('user.history');
Route::get('user/{id}/edituserid', 'AdminController@edituserid')->name('user.edituserid');
Route::post('user/edituseridstore', 'AdminController@edituseridstore')->name('user.edituseridstore');

Route::get('user/{id}/coins', 'AdminController@coins')->name('user.coins');

Route::get('history', 'AdminController@history')->name('history');
Route::get('history/success/{id}', 'AdminController@historySuccess')->name('history.success');
Route::get('history/failed/{id}', 'AdminController@historyFailed')->name('history.failed');

Route::get('settings/index', 'AdminController@settings')->name('settings.index');
Route::post('settings/store', 'AdminController@settings_store')->name('settings.store');

Route::get('admin_wallet', 'AdminController@AdminWallets')->name('wallet.details');
Route::post('admin_wallet', 'AdminController@StoreWalletAddress');

Route::get('settings/payment', 'AdminController@settings_payment')->name('settings.payment');
Route::post('settings/payment', 'AdminController@settings_payment_store')->name('settings.payment.store');

Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');

Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');


//Tokenizer
Route::get('/tokenizerindex','TokenizerController@tokenizerindex')->name('tokenizerindex');
Route::get('/tokenizer','TokenizerController@tokenizer')->name('tokenizer');

Route::get('/tokenizeredit/{id}','TokenizerController@tokenizeredit')->name('tokenizeredit');
Route::post('/tokenizerupdate','TokenizerController@tokenizerupdate')->name('tokenizerupdate');

Route::get('/requestedtoken','TokenizerController@requestedtoken')->name('requestedtoken');

Route::get('/get_property_details/{id}', 'TokenizerController@GetPropertyDetails');

Route::post('/update_interest', 'TokenizerController@UpdateInterest');

Route::get('/tokenhistory','TokenizerController@tokenhistory')->name('tokenhistory');
Route::get('/issuertokencontract/{id}','TokenizerController@issuertokencontract')->name('issuertokencontract');

Route::get('/issuertokencontracttest/{id}','TokenizerController@issuertokencontracttest')->name('issuertokencontracttest');
Route::get('/issuertokenreject/{id}','TokenizerController@/requestedtoken')->name('issuertokenreject');
Route::get('/requestedtoken/{id}', 'AdminController@tokenDetails')->name('issuerReqTokenDetails');



Route::post('/contractcreate', 'TokenizerController@contractcreate')->name('contractcreate');
Route::post('/contract/update', 'TokenizerController@contractupdate')->name('contractupdate');


//User Token

Route::get('/usertoken/index','UserTokenController@index')->name('usertoken.index');

Route::get('/get_whitelist_details/{prop_id}/{user_id}', 'UserTokenController@GetWhitelistDetails');

Route::get('/usertoken/usertransaction/{id}','UserTokenController@index')->name('usertoken.usertransaction');

Route::get('/usertoken/transaction','UserTokenController@tokentransaction')->name('usertoken.transaction');

Route::get('/usertoken/transactionstatus/{id}','UserTokenController@tokentransactionstatus')->name('usertoken.transactionstatus');

Route::get('/dividend','UserTokenController@dividend')->name('dividend');



//fiat History
Route::get('fiatHistory', 'AdminController@fiatHistory')->name('fiatHistory');
Route::get('walletHistory', 'AdminController@walletHistory')->name('walletHistory');

Route::get('/translation',  'AdminController@translation')->name('translation');

//History
Route::get('history', 'AdminController@history')->name('history');

//Privacy
Route::get('/privacy', 'AdminController@privacy')->name('privacy');
Route::post('/privacy_store','AdminController@privacy_store');

Route::post('/pages', 'AdminController@pages')->name('pages.update');

//Terms
Route::get('/terms', 'AdminController@terms')->name('terms');
Route::post('/terms_store', 'AdminController@terms_store');

Route::post('/about_store','AdminController@about_store');

Route::post('/termspage', 'AdminController@termspages')->name('terms.update');

Route::get('/about', 'AdminController@about')->name('about');
Route::post('/aboutpages', 'AdminController@aboutpages')->name('about.update');

//Promocode
// Route::resource('promocode', 'PromocodeResource');

//Token
// Route::resource('token', 'TokenResource');
// Route::get('/token/document/{id}', 'TokenResource@viewdocument')->name('token.document');
// Route::post('/token/status', 'TokenResource@status');

//Document Resource
Route::resource('document', 'DocumentResource');
Route::resource('corpdocument', 'CorpDocumentResource');

//AccreditedDocument Resource
Route::resource('accrediteddocument', 'AccreditedDocumentResource');

//ProspectusDocument Resource
Route::resource('prospectusdocument', 'ProspectusDocumentResource');

//Coins Resource
Route::resource('coin', 'CoinResource');
Route::get('coin/{id}/enableStatus', 'CoinResource@enableStatus')->name('coin.enableStatus');
Route::get('coin/{id}/disableStatus', 'CoinResource@disableStatus')->name('coin.disableStatus');

Route::get('user/{id}/kycdoc', 'AdminController@kycdoc')->name('user.kycdoc');
Route::post('userdocument/approve', 'AdminController@userdocument_approve')->name('userdocument.approve');
Route::post('userdocument/reject', 'AdminController@userdocument_reject')->name('userdocument.reject');

Route::get('{id}/accrediteddocs', 'AdminController@accrediteddoc')->name('user.accrediteddoc');
//Route::get('user/{id}/accrediteddocs', 'AdminController@accrediteddoc')->name('user.accrediteddoc');
Route::post('useraccrediteddocument/approve', 'AdminController@useraccrediteddocument_approve')->name('useraccrediteddocument.approve');
Route::post('useraccrediteddocument/reject', 'AdminController@useraccrediteddocument_reject')->name('useraccrediteddocument.reject');

Route::get('user/{id}/approve', 'AdminController@approve')->name('user.approve');
Route::get('user/{id}/disapprove', 'AdminController@disapprove')->name('user.disapprove');
Route::get('stripe-history', 'AdminController@stripeHistory')->name('user.stripe-history');

//withdraw

Route::get('pendingwithdraw', 'AdminController@pendingwithdraw')->name('pendingwithdraw');

Route::get('allwithdraw', 'AdminController@allwithdraw')->name('allwithdraw');


//cryptopendingwithdraw

Route::get('cryptopendingwithdraw', 'AdminController@cryptopendingwithdraw')->name('cryptopendingwithdraw');

Route::get('cryptoallwithdraw', 'AdminController@cryptoallwithdraw')->name('cryptoallwithdraw');



Route::get('history/success/{id}', 'AdminController@historySuccess')->name('history.success');

Route::get('history/failed/{id}', 'AdminController@historyFailed')->name('history.failed');

Route::get('coinwithdrawhistory/success/{id}', 'AdminController@coinwithdrawhistorySuccess')->name('coinwithdrawhistory.success');

Route::get('coinwithdrawhistory/failed/{id}', 'AdminController@coinwithdrawhistoryFailed')->name('coinwithdrawhistory.failed');


Route::get('receivehistory/success/{id}', 'AdminController@ReceivehistorySuccess')->name('receivehistory.success');

Route::get('receivehistory/failed/{id}', 'AdminController@ReceivehistoryFailed')->name('receivehistory.failed');

Route::post('addwireamount', 'AdminController@addwireamount')->name('addwireamount');
Route::get('removewireamount/{id}', 'AdminController@removewireamount')->name('removewireamount');

//Edit coin

Route::post('editcoin', 'AdminController@editcoin')->name('editcoin');

Route::post('savecoin', 'AdminController@savecoin')->name('savecoin');

Route::get('/btcotpgenerate/{ctype}', 'AdminController@btcotpgenerate')->name('btcotpgenerate');


Route::post('overallBTC', 'AdminController@overallBTC')->name('overallBTC');
Route::post('overallLTC', 'AdminController@overallLTC')->name('overallLTC');
Route::post('overallBCH', 'AdminController@overallBCH')->name('overallBCH');
Route::post('withdrawETH', 'AdminController@withdrawETH')->name('withdrawETH');

Route::any('withETH', 'AdminController@withdrawETH');

Route::get('/support','AdminController@support')->name('support');
//supportdone
Route::get('/supportdone/{id}/{status}','AdminController@supportdone')->name('supportdone');

Route::get('/addtoken','AdminController@addtoken')->name('addtoken');
//addtokendone
Route::get('/addtokendone/{id}','AdminController@addtokendone')->name('addtokendone');


//Sub Admin

Route::get('/listsubadmin', 'AdminController@listsubadmin')->name('listsubadmin');
Route::get('/createsubadmin', 'AdminController@createsubadmin')->name('createsubadmin');
Route::get('/editsubadmin/{id}', 'AdminController@editsubadmin')->name('editsubadmin');
Route::post('/storesubadmin', 'AdminController@storesubadmin')->name('storesubadmin');
Route::post('/updatesubadmin', 'AdminController@updatesubadmin')->name('updatesubadmin');
Route::delete('/destroysubadmin/{id}', 'AdminController@destroysubadmin')->name('destroysubadmin');

//sendmailforkycrejection
Route::get('sendmailforkycrejection', 'AdminController@sendmailforkycrejection')->name('sendmailforkycrejection');
Route::get('kycmail', 'AdminController@kycmail')->name('kycmail');

// Voting
Route::resource('vote', 'VoteController');
Route::get('vote/status/{id}', 'VoteController@status')->name('admin.vote.status');

Route::get('voteresult/{id}', 'VoteController@voteresult')->name('vote.voteresult');


// Type of Funds
Route::get('/fund', 'InvestorController@indexfund')->name('fund');
Route::get('/createfund', 'InvestorController@createfund')->name('createfund');
Route::get('/editfund/{id}', 'InvestorController@editfund')->name('editfund');
Route::post('/storefund', 'InvestorController@storefund')->name('storefund');
Route::post('/updatefund', 'InvestorController@updatefund')->name('updatefund');

// Investor Types
Route::resource('investor', 'InvestorController');

// Worth Status
Route::get('/worthstatus', 'InvestorController@indexworthstatus')->name('worthstatus');
Route::get('/createworthstatus', 'InvestorController@createworthstatus')->name('createworthstatus');
Route::get('/editworthstatus/{id}', 'InvestorController@editworthstatus')->name('editworthstatus');
Route::post('/storeworthstatus', 'InvestorController@storeworthstatus')->name('storeworthstatus');
Route::post('/updateworthstatus', 'InvestorController@updateworthstatus')->name('updateworthstatus');


//Property
Route::get('asset-fund', 'PropertyController@assetfundList')->name('assetfund');
Route::resource('property','PropertyController');
Route::post('property/assetfund', 'PropertyController@Storeassetfund');
Route::get('propertyFeature/{id}', 'PropertyController@propertyFeature');
Route::post('propertyStatus/{id}', 'PropertyController@propertyStatus');
Route::get('property/show/assetType', 'PropertyController@ShowAssetType')->name('property.showasset');

Route::get('/edit_commission/{id}', 'PropertyController@EditCommission');
Route::post('/edit_commission', 'PropertyController@UpdateCommission');

Route::get('/node_details', 'AdminController@NodeDetails')->name('node.details');
Route::get('/wallet/{address}/{type}/{chain}', 'AdminController@AdminWalletTransactions');

//Delete Document
Route::post('propertydocumentdelete', 'PropertyController@documentdelete')->name('property.documentdelete');
Route::get('property/create/assetType', 'PropertyController@CreateAssetType')->name('property.createasset');
Route::post('property/store/assetType','PropertyController@storeAssetType')->name('property.storeasset');
Route::get('property/edit/assetType/{id}', 'PropertyController@showEdit')->name('property.editasset');
Route::post('property/update/assetType/{id}', 'PropertyController@updateAssetType')->name('property.updateasset');
Route::get('property/delete/assetType/{id}', 'PropertyController@deleteAssetType')->name('property.deleteasset');
Route::post('/deleteprop', 'PropertyController@deleteproperty');

Route::get('add_bank_fields', 'PropertyController@AddFields');

Route::get('/bank_fields', 'PropertyController@ListFields')->name('addbankfields');
Route::post('/add_bank_fields', 'PropertyController@StoreFields');
Route::get('/edit_bank_field/{id}', 'PropertyController@EditFields');
Route::post('/update_bank_fields', 'PropertyController@UpdateFields');

Route::get('/add_bank_details', 'PropertyController@AddBankDetails')->name('addbankDetails');
Route::post('/add_bank_details', 'PropertyController@StoreBankDetails');
Route::get('/deposit_fiat', 'PropertyController@GetDepositRequest')->name('depositeRequest');
Route::get('/deposit_history', 'PropertyController@GetDepositHistory')->name('depositeHistory');
Route::get('/update_deposit/{id}/{status}', 'PropertyController@UpdateDepositRequest');

Route::get('crypto_deposit_request', 'AdminController@CryptoDepositRequest')->name('crypto.deposit');
Route::get('/update_crypto_deposit/{id}/{status}', 'AdminController@UpdateCryptoDepositRequest');
Route::get('crypto_deposit_history', 'AdminController@CryptoDepositHistory')->name('crypto.deposit.history');

Route::get('/withdraw_list', 'AdminController@WithdrawRequest')->name('withdraw.request');
Route::get('/update_withdraw/{id}/{status}', 'AdminController@UpdateWithdrawRequest');
Route::get('/withdraw_history', 'AdminController@WithdrawHistory')->name('withdraw.history');

Route::get('/whitelist_request', 'AdminController@GetWhiteListRequest');
Route::get('/update_whitelist_request/{id}/{status}', 'AdminController@UpdateWhiteListRequest');

Route::get('/get_gas_requests', 'AdminController@GasRequest')->name('gas.request');
Route::get('update_gas_request/{id}/{status}', 'AdminController@UpdateGasRequest');

Route::get('/crypto_withdraw_list', 'AdminController@CryptoWithdrawRequest')->name('crypto.withdraw.request');
Route::get('/update_crypto_withdraw/{id}/{status}', 'AdminController@UpdateCryptoWithdrawRequest');
Route::get('/crypto_withdraw_history', 'AdminController@CryptoWithdrawHistory')->name('crypto.withdraw.history');

Route::post('/update_crypto_request', 'AdminController@ApproveCryptoWithdrawRequest');

Route::post('/database/export', [DatabaseController::class, 'backup'])->name('database.export');
Route::get('/database/import', [DatabaseController::class, 'showImport'])->name('database.import.form');
Route::post('/database/import', [DatabaseController::class, 'import'])->name('database.import.upload');

Route::get('/page-visibility', [PageVisibilityController::class, 'index'])->name('page-visibility.index');
Route::post('/page-visibility', [PageVisibilityController::class, 'update'])->name('page-visibility.update');

// Mailgun Test Routes
Route::get('/mailgun/test', 'MailgunTestController@index')->name('mailgun.test');
Route::post('/mailgun/send-test-email', 'MailgunTestController@sendTestEmail')->name('mailgun.send-test-email');
Route::post('/mailgun/quick-test', 'MailgunTestController@quickTest')->name('mailgun.quick-test');