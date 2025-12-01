<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_identities', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('user_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('residence')->nullable();
            $table->string('ssn_tax_id')->nullable();
            $table->string('document')->nullable();
            $table->string('photo')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->mediumText('address_line_1')->nullable();
            $table->mediumText('address_line_2')->nullable(); 
            $table->string('country_code')->nullable();
            $table->integer('city_id')->unsigned();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });

        Schema::table('user_identities', function (Blueprint $table) { 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_identities');
    }
}
