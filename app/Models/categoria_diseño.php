<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria_diseño extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'categoria'];
    use HasFactory;
}
