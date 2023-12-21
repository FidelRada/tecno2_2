<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = ['cantidadingresada', 'fechaingreso', 'preciounitarioingreso', 'totalingreso', 'insumo_id', 'proveedor_id'];

    public function insumo(){
        return $this->belongsTo(Insumo::class);
    }
}
