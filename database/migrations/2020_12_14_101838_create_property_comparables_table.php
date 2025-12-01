<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyComparablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_comparables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->default(0);
            $table->string('property')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->double('distance')->default(0);
            $table->double('rent')->default(0);
            $table->double('saleprice')->default(0);
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
        Schema::dropIfExists('property_comparables');
    }
}
