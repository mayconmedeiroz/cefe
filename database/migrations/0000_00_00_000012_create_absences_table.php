<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_grade_id')->unsigned();
            $table->tinyInteger('absences')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('student_grade_id')->references('id')->on('student_grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('student_grades_student_grade_id_foreign');
        });

        Schema::dropIfExists('attendances');
    }
}
