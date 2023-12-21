<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'apellidopaterno',
        'apellidomaterno',
        'ci',
        'telefono',
        'direccion',
        'nombreempresa',
        'cargoproveedor',
        'telefonoreferencia',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
