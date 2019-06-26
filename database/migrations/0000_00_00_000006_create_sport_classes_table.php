<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sport_id')->unsigned();
            $table->string('name', '20');
            $table->tinyInteger('weekday')->unsigned();
            $table->time('start_time');
            $table->time('end_time');
            $table->string('vacancies', '4');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sport_id')->references('id')->on('sports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sport_classes', function (Blueprint $table) {
            $table->dropForeign('sport_classes_sport_id_foreign');
        });

        Schema::dropIfExists('sport_classes');
    }
}
