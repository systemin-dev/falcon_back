<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('boat_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boat_id')->constrained()->onDelete('cascade');
            $table->string('locale');
            $table->string('description');
            $table->string('base');
            $table->string('construction_type');
            $table->string('flat_board');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boat_translations');
    }
}
