<?php

namespace App\Filament\Resources\AgricultorResource\Pages;

use App\Filament\Resources\AgricultorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgricultores extends ListRecords
{
    protected static string $resource = AgricultorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}


