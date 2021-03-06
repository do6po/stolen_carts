<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakesTable extends Migration
{

    public function up()
    {
        Schema::create(
            'car_makes',
            function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('car_makes');
    }
}
