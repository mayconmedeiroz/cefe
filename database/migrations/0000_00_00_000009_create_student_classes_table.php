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
            $table->integer('school_year_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('sport_class_id')->references('id')->on('sport_classes');
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
        Schema::table('student_classes', function (Blueprint $table) {
            $table->dropForeign('student_classes_school_years_id_foreign');
            $table->dropForeign('student_classes_student_id_id_foreign');
            $table->dropForeign('student_classes_sport_class_id_foreign');
        });

        Schema::dropIfExists('student_classes');
    }
}
