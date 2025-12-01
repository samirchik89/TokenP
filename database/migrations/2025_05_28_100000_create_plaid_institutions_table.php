<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaidInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::create('plaid_institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution_id'); // Plaid's institution ID
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('primary_color')->nullable();
            $table->text('products')->nullable(); // Available products (auth, transactions, etc)
            $table->text('country_codes')->nullable(); // Countries where institution operates
            $table->text('oauth')->nullable(); // OAuth-related configuration
            $table->text('status')->nullable(); // Institution's status information
            $table->text('routing_numbers')->nullable(); // Institution's routing numbers
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plaid_institutions');
    }
};
