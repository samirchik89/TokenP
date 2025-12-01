<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaidItemAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plaid_item_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plaid_item_id');
            $table->string('account_id');
            $table->string('persistent_account_id')->nullable();
            $table->string('name');
            $table->string('official_name')->nullable();
            $table->string('type');
            $table->string('subtype')->nullable();
            $table->string('mask')->nullable();
            $table->string('status')->default('active');
            $table->json('balances')->nullable();
            $table->json('extra_data')->nullable();
            $table->timestamps();

            // Add composite index for faster lookups
            $table->index(['account_id']);
        });

        Schema::table('plaid_items', function (Blueprint $table) {
            $table->dropColumn('accounts_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plaid_item_accounts');
    }
}
