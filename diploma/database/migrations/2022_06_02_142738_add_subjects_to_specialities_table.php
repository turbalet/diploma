<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialities', function (Blueprint $table) {
            $table->unsignedBigInteger('first_subject')->default(1);
            $table->unsignedBigInteger('second_subject')->default(2);
            $table->foreign('first_subject')->references('id')->on('subjects');
            $table->foreign('second_subject')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specialities', function (Blueprint $table) {
            //
        });
    }
};
