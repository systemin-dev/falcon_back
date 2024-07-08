<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatRangesTable extends Migration
{
    public function up()
    {
        Schema::create('boat_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->string('name');
            $table->integer('weight');
            $table->timestamps();

            $table->foreign('boat_id')->references('id')->on('boats')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('boat_ranges');
    }
}
