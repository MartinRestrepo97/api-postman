<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vegetal extends Model
{
    protected $hidden = [];
    use HasFactory, SoftDeletes;

    protected $table = 'vegetales';
    protected $fillable = [
        'especie',
        'cultivo',
        'observaciones',
        'imagen',
    ];

    public function agricultores()
    {
        return $this->belongsToMany(
            Agricultor::class,
            'agricultores_vegetales',
            'id_vegetal',
            'id_agricultor'
        );
    }
}
