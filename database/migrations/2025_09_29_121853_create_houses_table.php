<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('description');
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->text('city');
            $table->text('county');
            $table->text('zip');
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('square_metres');
            $table->enum('energy_rating', ['A1', 'A2', 'A3', 'B1', 'B2', 'B3',  'C1', 'C2', 'C3', 'D1', 'D2', 'E1', 'E2', 'F', 'G']);
            $table->enum('house_type', ['detached', 'semi-detached', 'terraced', 'bungalow', 'apartment', 'studio']);
            $table->string('featured_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
