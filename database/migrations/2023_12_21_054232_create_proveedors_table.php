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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidopaterno');
            $table->string('apellidomaterno');
            $table->string('ci');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('nombreempresa');            
            $table->string('cargoproveedor');            
            $table->string('telefonoreferencia');            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};