<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePlaitItemAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plaid_item_account_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plaid_item_account_id');
            $table->string('network_key');
            $table->string('account')->nullable();
            $table->string('routing')->nullable();
            $table->string('wire_routing')->nullable();
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
        Schema::dropIfExists('plaid_item_account_numbers');
    }
}
