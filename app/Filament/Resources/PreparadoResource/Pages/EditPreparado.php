<?php

namespace App\Filament\Resources\PreparadoResource\Pages;

use App\Filament\Resources\PreparadoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreparado extends EditRecord
{
    protected static string $resource = PreparadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
