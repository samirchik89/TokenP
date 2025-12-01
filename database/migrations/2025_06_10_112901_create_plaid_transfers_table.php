<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaidTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plaid_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('plaid_item_id');
            $table->integer('plaid_item_account_id');
            $table->string('transfer_id')->unique()->nullable();
            $table->string('authorization_id')->nullable();
            $table->string('type')->default('debit');
            $table->string('network')->default('ach');
            $table->decimal('amount', 10, 2);
            $table->string('description')->nullable();
            $table->string('status')->default('pending');
            $table->string('failure_reason')->nullable();
            $table->string('ach_class')->nullable();
            $table->string('origination_account_id')->nullable();
            $table->text('send_metadata')->nullable();
            $table->text('receive_metadata')->nullable();
            $table->text('webhook_data')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->timestamp('posted_date')->nullable();
            $table->timestamp('cancelled_date')->nullable();
            $table->timestamp('failed_date')->nullable();
            $table->timestamp('returned_date')->nullable();
            $table->timestamps();


            // Indexes
            $table->index(['user_id', 'status']);
            $table->index(['plaid_item_id', 'status']);
            $table->index('transfer_id');
            $table->index('authorization_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plaid_transfers');
    }
}
