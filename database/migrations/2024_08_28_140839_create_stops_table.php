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
        Schema::create('stops', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // VARCHAR(255)
            $table->text('description')->nullable(); // TEXT
            $table->tinyInteger('vote')->unsigned()->nullable();
            $table->string('notes')->nullable();

            // foreign key
            $table->foreignId('day_id')->constrained('days')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops');
    }
};
