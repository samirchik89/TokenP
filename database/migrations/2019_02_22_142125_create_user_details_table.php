<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('address');
            $table->string('address_two')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country_id');
            $table->integer('address_proof_status')->default(0)->comment('0-Not,1-Verified');
            $table->string('address_proof')->nullable();
            $table->integer('verify_human_status')->default(0)->comment('0-Not,1-Verified');
            $table->string('verify_human')->nullable();
            $table->integer('investor_type')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
