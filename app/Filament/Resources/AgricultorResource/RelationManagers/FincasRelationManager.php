<?php
namespace App\Filament\Resources\AgricultorResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class FincasRelationManager extends RelationManager
{
    protected static string $relationship = 'fincas';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->extraAttributes(['style' => 'margin:24px; border:2px solid #e5e7eb; background:#f9fafb; border-radius:8px;'])
            ->schema([
                // Puedes agregar campos adicionales si la tabla pivote tiene más columnas
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ubicacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('propietario')
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ]);
    }
}
