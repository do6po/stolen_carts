<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{

    public function up()
    {
        Schema::create(
            'cars',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('vin')->unique();
                $table->string('registration_plate')->unique();
                $table->string('color');
                $table->year('year');

                $table->unsignedBigInteger('model_id');
                $table->foreign('model_id')
                    ->on('car_models')
                    ->references('id')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
