<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PolisResource\Pages;
use App\Filament\Admin\Resources\PolisResource\RelationManagers;
use App\Models\poli;
use App\Models\Polis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PolisResource extends Resource
{
    protected static ?string $model = poli::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'rekam_medis';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPolis::route('/'),
            'create' => Pages\CreatePolis::route('/create'),
            'edit' => Pages\EditPolis::route('/{record}/edit'),
        ];
    }
}
