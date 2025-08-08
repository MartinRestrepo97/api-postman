<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Finca extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ubicacion',
        'propietario',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(
            Agricultor::class,
            'agricultores_fincas',
            'id_finca',
            'id_agricultor'
        );
    }
}
