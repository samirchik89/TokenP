<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsercontractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercontract', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('issued_by')->default(0);           
            $table->string('tokenname');
            $table->string('tokensymbol');
            $table->string('tokenvalue');
            $table->string('tokensupply');
            $table->string('contract_address')->nullable();
            $table->string('decimal')->nullable();
            $table->string('token_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('token_type')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('usercontract');
    }
}
