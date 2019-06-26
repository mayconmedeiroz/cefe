<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unsigned();
            $table->decimal('grade_1', 4, 2)->nullable();
            $table->decimal('attendance_1', 5, 2)->nullable();
            $table->decimal('grade_2', 4, 2)->nullable();
            $table->decimal('attendance_2', 5, 2)->nullable();
            $table->decimal('grade_3', 4, 2)->nullable();
            $table->decimal('attendance_3', 5, 2)->nullable();
            $table->year('school_year');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign('grades_student_id_foreign');
        });
        Schema::dropIfExists('grades');
    }
}
