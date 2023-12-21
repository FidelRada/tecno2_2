<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forma_de_pago extends Model
{
    protected $fillable = ['nombre', 'descripcion'];
    use HasFactory;
}
