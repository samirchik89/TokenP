<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();  
            $table->string('investment_experience')->nullable();
            $table->mediumText('previously_invested')->nullable();
            $table->double('investment_size')->default(0);
            $table->string('property_type')->nullable();
            $table->mediumText('geography')->nullable();
            $table->string('holding_period')->nullable();
            $table->string('expected_investment_nxt_1year')->nullable();
            $table->string('expected_investment_per_project')->nullable();
            $table->mediumText('investment_type')->nullable();
            $table->string('investment_objective')->nullable();
            $table->string('risk_type')->nullable();
            $table->timestamps();
        });

        Schema::table('user_backgrounds', function (Blueprint $table) { 
            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_backgrounds');
    }
}
