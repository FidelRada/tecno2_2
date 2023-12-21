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
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('insumo_id')->constrained()->onDelete('cascade');
            
            $table->integer('cantidadegresada');
            $table->date('fechaegreso');
            $table->double('preciounitarioegreso');
            $table->double('totalegreso');            
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
