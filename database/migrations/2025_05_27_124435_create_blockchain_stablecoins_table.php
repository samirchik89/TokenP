<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockchainStablecoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blockchain_stablecoins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blockchain_id'); // removed foreignId()
            $table->unsignedInteger('stablecoin_id'); // removed foreignId()
            $table->string('address_testnet')->nullable();
            $table->string('address_mainnet')->nullable();
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
        Schema::dropIfExists('blockchain_stablecoins');
    }
}
