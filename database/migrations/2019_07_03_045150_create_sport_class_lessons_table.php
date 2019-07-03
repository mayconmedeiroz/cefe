<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportClassLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_class_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sport_class_id')->unsigned();
            $table->integer('evaluation_id')->unsigned();
            $table->tinyInteger('planned_classes')->unsigned();
            $table->tinyInteger('classes_held')->unsigned();
            $table->timestamps();

            $table->foreign('evaluation_id')->references('id')->on('evaluations');
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
        Schema::table('sport_class_lessons', function (Blueprint $table) {
            $table->dropForeign('sport_class_lessons_sport_class_id_foreign');
        });

        Schema::dropIfExists('sport_class_lessons');
    }
}