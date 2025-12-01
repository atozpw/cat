<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionGroupIdOnScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_details', function (Blueprint $table) {
            $table->unsignedBigInteger('question_group_id')->nullable()->after('question_category_id');
            $table->foreign('question_group_id')->references('id')->on('question_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_details', function (Blueprint $table) {
            $table->dropForeign('schedule_details_question_group_id_foreign');
            $table->dropColumn('question_group_id');
        });
    }
}
