<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsertokenForBuyProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Truncate the table before applying changes
        DB::table('user_tokens')->truncate();

        Schema::table('user_tokens', function (Blueprint $table) {
            $table->enum('status', ['inProgress', 'reject', 'success','failed'])->default('inProgress');
            $table->unsignedTinyInteger('current_stage')->default(0); 
            $table->unsignedBigInteger('payment_type_id')->required();
            $table->decimal('commssion', 15, 2)->default(0); 
            $table->decimal('deal_amount', 15, 2)->default(0);
            $table->text('note')->nullable();
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
                'payment_type_id',
                'commssion',
                'deal_amount',
                'note',
            ]);
        });
    }
}
