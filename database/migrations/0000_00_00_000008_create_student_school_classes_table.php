<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSchoolClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_school_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('school_class_id')->unsigned();
            $table->string('class_number', '2');
            $table->integer('school_year_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('school_class_id')->references('id')->on('school_classes');
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
        Schema::table('student_school_classes', function (Blueprint $table) {
            $table->dropForeign('student_school_school_years_id_foreign');
            $table->dropForeign('student_school_classes_student_id_foreign');
            $table->dropForeign('student_school_classes_school_class_id_foreign');
        });

        Schema::dropIfExists('student_school_classes');
    }
}
