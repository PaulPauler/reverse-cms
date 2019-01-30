<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeedbackLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback_log', function (Blueprint $table) {
            $table->integer('answer_status')->nullable();
            $table->string('answer_author')->nullable();
            $table->string('answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback_log', function (Blueprint $table) {
            $table->dropColumn('answer_status');
            $table->dropColumn('answer_author');
            $table->dropColumn('answer');
        });
    }
}
