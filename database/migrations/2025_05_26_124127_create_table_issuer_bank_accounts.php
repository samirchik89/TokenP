<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIssuerBankAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuer_bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('issuer_id');
            $table->string('bank_name');
            $table->string('bank_location')->required();
            $table->text('bank_address')->required();
            $table->string('bank_account_name')->required();
            $table->string('routing_details', 100)->nullable(); 
            $table->string('beneficiary_name')->required();
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
        Schema::dropIfExists('issuer_bank_accounts');
    }
}
