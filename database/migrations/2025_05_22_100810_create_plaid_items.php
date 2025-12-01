<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaidItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plaid_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('item_id');
            $table->text('access_token');
            $table->string('institution_id')->nullable();
            $table->string('status')->default('active');
            $table->text('transactions_cursor')->nullable();
            $table->json('accounts_data')->nullable();
            $table->json('error_info')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plaid_items');
    }
}
