<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestiontypeColumnsToVotequestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votequestions', function (Blueprint $table) {
            $table->integer('question_type')->comment('0-y/n,1-option,2-multichoice')->after('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votequestions', function (Blueprint $table) {
           $table->dropColumn('question_type');
        });
    }
}
