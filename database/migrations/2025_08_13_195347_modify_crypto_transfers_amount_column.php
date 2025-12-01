<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCryptoTransfersAmountColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crypto_transfers', function (Blueprint $table) {
            // Modify amount column to support larger decimal values
            // Using DECIMAL(20,8) to support up to 999999999999.99999999
            $table->decimal('amount', 20, 8)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crypto_transfers', function (Blueprint $table) {
            // Revert back to original decimal without precision/scale
            $table->decimal('amount')->change();
        });
    }
}
