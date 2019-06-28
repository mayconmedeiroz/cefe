<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecuperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recuperations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_grade_id')->unsigned();
            $table->decimal('grade', 4, 2)->nullable();
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
        Schema::table('recuperations', function (Blueprint $table) {
            $table->dropForeign('recuperations_student_grade_id_foreign');
        });

        Schema::dropIfExists('recuperations');
    }
}
