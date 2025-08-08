<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VegetalResource\Pages;
use App\Filament\Resources\VegetalResource\RelationManagers;
use App\Models\Vegetal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VegetalResource extends Resource
{
    protected static ?string $model = Vegetal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('especie')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cultivo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('observaciones')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('imagen')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('especie')->searchable(),
                Tables\Columns\TextColumn::make('cultivo')->searchable(),
                Tables\Columns\TextColumn::make('observaciones')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVegetales::route('/'),
            'create' => Pages\CreateVegetal::route('/create'),
            'edit' => Pages\EditVegetal::route('/{record}/edit'),
        ];
    }
}
