<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kejuruans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('durasi')->default(60);
            $table->string('status')->default('close');
            $table->unsignedInteger('kejuruan_id');
            $table->timestamps();

            $table->foreign('kejuruan_id')->references('id')->on('kejuruans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
        Schema::dropIfExists('kejuruans');
    }
}
