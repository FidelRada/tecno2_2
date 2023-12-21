<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'costo'];

    /*
    public function posts(){
        return $this->hasMany(Post::class);
    }*/
}
