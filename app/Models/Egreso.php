<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $fillable = ['cantidadegresada', 'fechaegreso', 'preciounitarioegreso', 'totalegreso', 'insumo_id'];

    public function insumo(){
        return $this->belongsTo(Insumo::class);
    }

    
}
