<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePaymentTypeIdFromUserTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('user_tokens', 'payment_type_id')) {
            Schema::table('user_tokens', function (Blueprint $table) {
                $table->dropColumn('payment_type_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('user_tokens', 'payment_type_id')) {
            Schema::table('user_tokens', function (Blueprint $table) {
                $table->unsignedBigInteger('payment_type_id')->nullable();
            });
        }
    }
}
