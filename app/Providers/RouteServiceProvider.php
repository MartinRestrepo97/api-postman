<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Agricultor;
use App\Models\Animal;
use App\Models\Vegetal;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
    parent::boot();
    }
}
