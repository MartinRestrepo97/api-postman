<?php

namespace App\Filament\Resources\VegetalResource\Pages;

use App\Filament\Resources\VegetalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVegetales extends ListRecords
{
    protected static string $resource = VegetalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
