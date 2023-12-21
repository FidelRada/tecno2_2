<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaInsumo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function insumos(){
        return $this->hasMany(Insumo::class);
    }

}
