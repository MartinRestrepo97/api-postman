<?php
namespace App\Filament\Resources\AgricultorResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class AnimalesRelationManager extends RelationManager
{
    protected static string $relationship = 'animales';

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
                Tables\Columns\TextColumn::make('especie')->searchable(),
                Tables\Columns\TextColumn::make('raza')->searchable(),
                Tables\Columns\TextColumn::make('alimentacion')->limit(30),
                Tables\Columns\TextColumn::make('cuidados')->limit(30),
                Tables\Columns\TextColumn::make('reproduccion')->limit(30),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ]);
    }
}
