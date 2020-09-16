<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaseIdColumnIntoCarMakesTable extends Migration
{
    public function up()
    {
        Schema::table(
            'car_makes',
            function (Blueprint $table) {
                $table->unsignedBigInteger('remote_id');
            }
        );
    }

    public function down()
    {
        Schema::table(
            'car_makes',
            function (Blueprint $table) {
                $table->dropColumn('remote_id');
            }
        );
    }
}
