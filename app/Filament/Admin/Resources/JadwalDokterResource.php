<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JadwalDokterResource\Pages;
use App\Models\JadwalDokter;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JadwalDokterResource extends Resource
{
    protected static ?string $model = JadwalDokter::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Manajemen Jadwal';

    protected static ?string $navigationGroup = 'Administrasi';

    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user->role === 'rekam_medis';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Dokter')
                    ->options(User::where('role', 'dokter')->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('jam_mulai')
                    ->required(),
                Forms\Components\TimePicker::make('jam_selesai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dokter.name')->label('Nama Dokter')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('hari')->sortable(),
                Tables\Columns\TextColumn::make('jam_mulai')->time(),
                Tables\Columns\TextColumn::make('jam_selesai')->time(),
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
            'index' => Pages\ListJadwalDokters::route('/'),
            'create' => Pages\CreateJadwalDokter::route('/create'),
            'edit' => Pages\EditJadwalDokter::route('/{record}/edit'),
        ];
    }
}
