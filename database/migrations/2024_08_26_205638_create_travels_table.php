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
            $table->id(); // Crea una colonna auto-incrementante 'id' come chiave primaria

            // Colonne aggiuntive
            $table->string('name'); // VARCHAR(255)
            $table->text('description')->nullable(); // TEXT
            $table->string('image')->nullable(); // VARCHAR(255)
            $table->date('date_start')->nullable(); // DATE

            // Colonna chiave esterna
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps(); // Aggiunge le colonne 'created_at' e 'updated_at'
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
