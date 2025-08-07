<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vegetal extends Model
{
    protected $fillable = [
        'especie',
        'cultivo',
        'observaciones',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultor_vegetal');
    }
}
