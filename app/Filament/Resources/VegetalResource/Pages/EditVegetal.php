<?php

namespace App\Filament\Resources\VegetalResource\Pages;

use App\Filament\Resources\VegetalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVegetal extends EditRecord
{
    protected static string $resource = VegetalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
