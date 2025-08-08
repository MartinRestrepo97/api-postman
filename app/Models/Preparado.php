<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preparado extends Model
{
    use HasFactory;

    protected $table = 'preparados';
    protected $fillable = [
        'nombre',
        'preparacion',
        'observaciones',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(
            Agricultor::class,
            'agricultores_preparados',
            'id_preparado',
            'id_agricultor'
        );
    }
}      