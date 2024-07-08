<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionsTable extends Migration
{
    public function up()
    {
        Schema::create('dimensions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->string('weight_range');
            $table->integer('mold_number');
            $table->integer('length_cm');
            $table->string('boat_type');
            $table->string('shape');
            $table->timestamps();

            $table->foreign('boat_id')->references('id')->on('boats')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dimensions');
    }
}
