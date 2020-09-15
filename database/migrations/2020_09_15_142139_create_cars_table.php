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
                $table->string('registration_plate')->unique();
                $table->string('color')->nullable();

                $table->unsignedBigInteger('make_id');
                $table->foreign('make_id')
                    ->references('id')
                    ->on('makes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->string('model');
                $table->year('year')->nullable();

                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
