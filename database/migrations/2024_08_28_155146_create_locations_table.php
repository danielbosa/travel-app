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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // VARCHAR(255)
            $table->decimal('lat', 10, 8); // DECIMAL(10,8)
            $table->decimal('lng', 11, 8); // DECIMAL(11,8)

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
        Schema::dropIfExists('locations');
    }
};
