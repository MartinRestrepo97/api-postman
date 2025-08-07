<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'especie',
        'raza',
        'alimentacion',
        'cuidados',
        'reproduccion',
        'observaciones',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultor_animal');
    }
}
