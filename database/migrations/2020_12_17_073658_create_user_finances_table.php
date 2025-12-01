<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_finances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); 
            $table->string('type_of_ownership')->nullable();
            $table->string('us_resident')->comment('YES,NO')->nullable();
            $table->string('us_citizen')->comment('YES,NO')->nullable();
            $table->string('ssn_tax_id')->comment('SSN,TAX ID')->nullable();
            $table->string('custodial_account')->comment('YES,NO')->nullable();
            $table->mediumText('accreditation')->nullable();
            $table->string('e_signature')->nullable();
            $table->string('preferred_distribution')->nullable();
            $table->string('routing_aba_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('financial_insitution')->nullable();
            $table->string('financial_insitution_address')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('beneficiary_acc_number')->nullable();
            $table->string('beneficiary_acc_address')->nullable();
            $table->mediumText('funding_note')->nullable();
            $table->string('further_credit')->nullable();
            $table->string('attn')->nullable();  
            $table->timestamps();
        });
        Schema::table('user_finances', function (Blueprint $table) { 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_finances');
    }
}
