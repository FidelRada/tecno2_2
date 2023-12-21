<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'marca', 'descripcion', 'preciocompra', 'porcentajeventa', 'precioventa', 'cantidaddisponible', 'categoria_insumo_id'];

    public function categoriainsumo(){
        return $this->belongsTo(CategoriaInsumo::class);
    }
}
