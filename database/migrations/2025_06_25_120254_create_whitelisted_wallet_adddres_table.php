<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhitelistedWalletAdddresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whitelisted_wallet_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->required();
            $table->string('whitelisted_by')->required();
            $table->enum('status', ['1', '0'])->default('0');
            $table->string('tx_hash')->required();
            $table->string('wallet_address')->required();
            $table->string('contract_id')->required();
            $table->timestamps();
            $table->unique(['user_id', 'contract_id', 'wallet_address'], 'unique_user_contract_wallet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whitelisted_wallet_adddresses');
    }
}
