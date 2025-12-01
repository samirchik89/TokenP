<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositFiatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_fiats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('amount');
            $table->string('proof');
            $table->string('bank_id');
            $table->enum('status',['Pending', 'Confirm', 'Cancel'])->default('Pending');
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
        Schema::dropIfExists('deposit_fiats');
    }
}
