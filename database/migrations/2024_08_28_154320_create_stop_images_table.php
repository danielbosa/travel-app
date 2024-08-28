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
        Schema::create('stop_images', function (Blueprint $table) {
            $table->id();

            $table->string('image_path')->nullable(); // VARCHAR(255)

            // foreign key
            $table->foreignId('stop_id')->constrained('stops')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stop_images');
    }
};
