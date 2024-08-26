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
        Schema::create('travels', function (Blueprint $table) {
            $table->id(); // primary key auto-increment

            // Columns
            $table->string('name'); // VARCHAR(255)
            $table->text('description')->nullable(); // TEXT
            $table->string('image')->nullable(); // VARCHAR(255)
            $table->date('date_start')->nullable(); // DATE

            // foreign key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps(); // 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};
