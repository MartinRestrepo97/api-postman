<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preparado extends Model
{
    protected $fillable = [
        'nombre',
        'preparacion',
        'observaciones',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultor_preparado');
    }
}      