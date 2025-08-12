<?php

namespace App\Filament\Resources\AgricultorResource\Pages;

use App\Filament\Resources\AgricultorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgricultor extends CreateRecord
{
    protected static string $resource = AgricultorResource::class;

    protected function getCreatedNotificationRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getRelationManagers(): array
    {
        return $this->getResource()::getRelations();
    }
}
