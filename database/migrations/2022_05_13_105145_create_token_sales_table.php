<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_mode')->nullable();
            $table->string('address');
            $table->string('tx_hash');
            $table->enum('status',['PENDING','SUCCESS','FAILED'])->default('PENDING');
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
        Schema::dropIfExists('token_sales');
    }
}
