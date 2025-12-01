<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('headquarters')->nullable();
            $table->date('date_founded')->nullable();
            $table->integer('team_size')->nullable();
            $table->string('company_url')->nullable();
            $table->text('social_channels')->nullable();
            $table->string('team_leader_name')->nullable();
            $table->string('profile_image')->nullable();
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
        Schema::dropIfExists('user_company_details');
    }
}
