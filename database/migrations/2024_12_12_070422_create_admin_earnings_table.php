<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('trx_id');
            $table->string('contract_id');
            $table->string('payment');
            $table->string('amount');
            $table->string('trx_amount');
            $table->string('earning');
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
        Schema::dropIfExists('admin_earnings');
    }
}
