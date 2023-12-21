<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'apellidopaterno',
        'apellidomaterno',
        'ci',
        'telefono',
        'direccion',
        'nit',
        'nrotarjetadecredito',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
