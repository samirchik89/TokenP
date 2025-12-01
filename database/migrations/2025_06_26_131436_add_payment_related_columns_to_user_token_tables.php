<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentRelatedColumnsToUserTokenTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tokens', function (Blueprint $table) {
            $table->string('payment_mode')->nullable();
            $table->unsignedBigInteger('payment_mode_id')->nullable()->after('payment_mode');
            $table->string('payment_reference_id')->nullable()->after('payment_mode_id');
            $table->string('payment_proof_url')->nullable()->after('payment_reference_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_tokens', function (Blueprint $table) {
            $table->dropColumn([
                'payment_mode',
                'payment_mode_id',
                'payment_reference_id',
                'payment_proof_url'
            ]);
        });
    }
}
