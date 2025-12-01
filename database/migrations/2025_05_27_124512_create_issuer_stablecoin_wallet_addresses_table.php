<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuerStablecoinWalletAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuer_stablecoin_wallet_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('issuer_id');
            $table->unsignedInteger('blockchain_id');
            $table->unsignedInteger('stablecoin_id');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issuer_stablecoin_wallet_addresses');
    }
}
