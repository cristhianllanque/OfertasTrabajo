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
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id(); // Definición de la columna 'id'
            $table->string('title');
            $table->text('description');
            $table->string('salary')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con el usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
