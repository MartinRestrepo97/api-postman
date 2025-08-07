<?php

namespace App\Filament\Resources\PreparadoResource\Pages;

use App\Filament\Resources\PreparadoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreparados extends ListRecords
{
    protected static string $resource = PreparadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
