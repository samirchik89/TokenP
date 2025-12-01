<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTokenTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_token_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('user_token_id');
            $table->integer('user_contract_id');
            $table->string('payment_type',50);
            $table->integer('payment_amount');
            $table->integer('token_price');
            $table->double('number_of_token',15,8);
            $table->tinyInteger('status')->comment('1-Success,2-Pending');
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
        Schema::dropIfExists('user_token_transactions');
    }
}
