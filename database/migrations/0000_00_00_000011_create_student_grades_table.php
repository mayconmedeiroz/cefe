<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('evaluation_id')->unsigned();
            $table->decimal('grade', 4, 2)->nullable();
            $table->integer('school_year_id')->unsigned();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('evaluation_id')->references('id')->on('evaluations');
            $table->foreign('school_year_id')->references('id')->on('school_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_grades', function (Blueprint $table) {
            $table->dropForeign('student_grades_school_years_id_foreign');
            $table->dropForeign('student_grades_student_id_foreign');
            $table->dropForeign('student_grades_evaluation_id_foreign');
        });

        Schema::dropIfExists('student_grades');
    }
}
