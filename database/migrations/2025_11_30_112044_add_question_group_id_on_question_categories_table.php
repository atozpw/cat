<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionGroupIdOnQuestionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('question_group_id')->nullable()->after('duration');
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
        Schema::table('question_categories', function (Blueprint $table) {
            $table->dropForeign('question_categories_question_group_id_foreign');
            $table->dropColumn('question_group_id');
        });
    }
}
