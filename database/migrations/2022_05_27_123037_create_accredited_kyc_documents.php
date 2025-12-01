<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccreditedKycDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accredited_kyc_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('accredited_document_id');
            $table->longText('url')->nullable();
            $table->string('unique_id')->nullable();
            $table->enum('status', ['PENDING', 'SUCCESS', 'FAILED', 'REJECTED', 'APPROVED', 'PROCESSING'])->nullable()->default('PENDING');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accredited_kyc_documents');
    }
}
