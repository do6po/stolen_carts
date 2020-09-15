<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{

    public function up()
    {
        Schema::create(
            'car_models',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');

                $table->unsignedBigInteger('make_id');
                $table->foreign('make_id')
                    ->references('id')
                    ->on('car_makes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->unique(['name', 'make_id']);
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
