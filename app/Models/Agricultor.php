<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'imagen',
        'documento',
    ];

    public function fincas()
    {
        return $this->belongsToMany(Finca::class, 'agricultor_finca');
    }

    public function animales()
    {
        return $this->belongsToMany(Animal::class, 'agricultor_animal');
    }

    public function vegetales()
    {
        return $this->belongsToMany(Vegetal::class, 'agricultor_vegetal');
    }

    public function preparados()
    {
        return $this->belongsToMany(Preparado::class, 'agricultor_preparado');
    }
}
