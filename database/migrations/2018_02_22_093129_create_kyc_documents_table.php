<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKycDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('document_id');
            $table->string('url');
            $table->string('unique_id')->nullable();
            $table->enum('status', ['PENDING', 'APPROVED' , 'REJECTED']);
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
        Schema::dropIfExists('kyc_documents');
    }
}
