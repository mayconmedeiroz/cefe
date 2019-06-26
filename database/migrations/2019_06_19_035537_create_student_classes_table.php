<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->unsigned();
            $table->integer('sport_class_id')->unsigned();
            $table->year('school_year');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('sport_class_id')->references('id')->on('sport_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('student_classes_student_id_id_foreign');
            $table->dropForeign('student_classes_sport_class_id_foreign');
        });

        Schema::dropIfExists('student_classes');
    }
}
