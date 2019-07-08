<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecretariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('secretary_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->timestamps();

            $table->foreign('secretary_id')->references('id')->on('users');
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secretaries', function (Blueprint $table) {
            $table->dropForeign('secretaries_secretary_id_foreign');
            $table->dropForeign('secretaries_school_id_foreign');
        });

        Schema::dropIfExists('secretaries');
    }
}
