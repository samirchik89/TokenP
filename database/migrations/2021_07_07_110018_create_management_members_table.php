<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->default(0);
            $table->string('memberName')->nullable();
            $table->string('memberPic')->nullable();
            $table->string('memberDescription')->nullable();
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
        Schema::dropIfExists('management_members');
    }
}
