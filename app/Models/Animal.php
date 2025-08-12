<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    protected $hidden = [];
    use HasFactory, SoftDeletes;

    protected $table = 'animales';
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
        return $this->belongsToMany(
            Agricultor::class,
            'agricultores_animales',
            'id_animal',
            'id_agricultor'
        );
    }
}
