<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuerTokenRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuer_token_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->double('usdvalue')->default(0);
            $table->double('supply')->default(0);
            $table->integer('decimal')->default(0);
            $table->string('contract_address')->nullable();            
            $table->enum('security_type', ['erc721','erc20']);
            $table->string('token_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->enum('status', ['pending', 'live', 'rejected'])->default('pending');
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
        Schema::dropIfExists('issuer_token_requests');
    }
}
