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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insumo_id')->constrained()->onDelete('cascade');
            $table->integer('proveedor_id');
            
            $table->integer('cantidadingresada');
            $table->date('fechaingreso');
            $table->double('preciounitarioingreso');
            $table->double('totalingreso');
            
            
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
