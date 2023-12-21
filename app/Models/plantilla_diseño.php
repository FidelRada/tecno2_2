<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plantilla_diseño extends Model
{
    protected $fillable = ['nombre', 'URI_IMG', 'descripcion', 'categoria_id'];
    use HasFactory;
}
