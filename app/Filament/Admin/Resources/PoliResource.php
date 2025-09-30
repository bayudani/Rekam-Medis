<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PoliResource\Pages;
use App\Models\poli;
// use App\Models\Poli;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PoliResource extends Resource
{
    protected static ?string $model = poli::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Manajemen Poli';

    protected static ?string $navigationGroup = 'Administrasi';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user->role === 'rekam_medis';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_poli')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_poli')->searchable(),
                Tables\Columns\TextColumn::make('users_count')->counts('users')->label('Jumlah Dokter'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPolis::route('/'),
            'create' => Pages\CreatePoli::route('/create'),
            'edit' => Pages\EditPoli::route('/{record}/edit'),
        ];
    }
}
