<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion',
        'propietario',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultor_finca');
    }
}
