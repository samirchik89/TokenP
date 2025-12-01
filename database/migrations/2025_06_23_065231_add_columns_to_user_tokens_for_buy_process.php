<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserTokensForBuyProcess extends Migration
  {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Optional: truncate only if this is safe in your use case
        DB::table('user_tokens')->truncate();
        Schema::table('user_tokens', function (Blueprint $table) {
            // Drop the misspelled column if it exists
            if (Schema::hasColumn('user_tokens', 'commssion')) {
                $table->dropColumn('commssion');
            }

            // Drop and re-add status enum to add "inReview"
            $table->dropColumn('status');
        });

        Schema::table('user_tokens', function (Blueprint $table) {
            $table->enum('status', ['inProgress','inReview', 'reject', 'success'])->default('inProgress');
            $table->text('receiver_wallet_address')->nullable();
            $table->integer('issuer_id');
            $table->integer('property_id');
            $table->string('payment_by');
            $table->decimal('commission', 15, 2)->default(0); // corrected spelling
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
                'status',
                'current_stage',
                'commission',
                'deal_amount',
                'receiver_wallet_address',
                'note',
                'payment_by'
            ]);
        });
    }
}