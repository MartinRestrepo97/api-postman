<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgricultorResource\Pages;
use App\Filament\Resources\AgricultorResource\RelationManagers;
use App\Models\Agricultor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgricultorResource extends Resource
{
    protected static ?string $model = Agricultor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->extraAttributes([
                'class' => 'bg-filament-card border border-gray-700 rounded-xl p-6',
                'style' => 'margin:24px;'
            ])
            ->schema([
                Forms\Components\TextInput::make('nombres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('documento')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->maxLength(100)
                    ->placeholder('+34 600 000 000'),
                Forms\Components\TextInput::make('imagen')
                    ->label('Imagen (URL)')
                    ->url()
                    ->required()
                    ->columnSpanFull()
                    ->placeholder('https://...'),
                Forms\Components\Section::make('Relaciones')
                    ->schema([
                        Forms\Components\Select::make('fincas')
                            ->label('Fincas')
                            ->relationship('fincas', 'nombre')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('animales')
                            ->label('Animales')
                            ->relationship('animales', 'especie')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('vegetales')
                            ->label('Vegetales')
                            ->relationship('vegetales', 'especie')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Forms\Components\Select::make('preparados')
                            ->label('Preparados')
                            ->relationship('preparados', 'nombre')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombres')->searchable(),
                Tables\Columns\TextColumn::make('apellidos')->searchable(),
                Tables\Columns\TextColumn::make('telefono'),
                Tables\Columns\TextColumn::make('documento')->searchable(),
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
            RelationManagers\FincasRelationManager::class,
            RelationManagers\AnimalesRelationManager::class,
            RelationManagers\VegetalesRelationManager::class,
            RelationManagers\PreparadosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgricultor::route('/'),
            'create' => Pages\CreateAgricultor::route('/create'),
            'edit' => Pages\EditAgricultor::route('/{record}/edit'),
        ];
    }
}
