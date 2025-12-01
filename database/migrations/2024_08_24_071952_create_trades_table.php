<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('property_id');
            $table->string('user_contract_id');
            $table->string('no_of_tokens');
            $table->string('value_of_tokens');
            $table->string('buy');
            $table->string('buy_value');
            $table->string('token_hash')->nullable();
            $table->string('finish_hash')->nullable();
            $table->enum('status', ['Pending', 'Finished', 'Cancelled'])->default('Pending');
            $table->string('finished_by')->nullable();
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
        Schema::dropIfExists('trades');
    }
}
