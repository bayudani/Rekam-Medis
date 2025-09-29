<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftaranResource\Pages;
use App\Filament\Admin\Resources\PendaftaranResource\RelationManagers;
use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Symfony\Component\HttpFoundation\StreamedResponse;


class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationLabel = 'Pendaftaran Kunjungan';
    protected static ?int $navigationSort = 2;

    /**
     * Kontrol siapa yang bisa melihat menu ini di sidebar.
     * Hanya 'loket' dan 'rekam_medis' yang bisa melihat. Dokter tidak bisa.
     */
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user->role === 'loket' || $user->role === 'rekam_medis';
    }

    /**
     * Menambahkan badge notifikasi jumlah pasien yang sedang menunggu.
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Menunggu')->count();
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Kunjungan')
                    ->description('Pilih pasien dan tujuan poli.')
                    ->schema([
                        Forms\Components\Select::make('pasien_id')
                            ->label('Pasien')
                            ->relationship('pasien', 'nama')
                            ->searchable(['nama', 'no_rm'])
                            ->preload()
                            ->required()
                            // Bisa langsung buat pasien baru dari modal
                            ->createOptionForm([
                                Forms\Components\TextInput::make('no_rm')
                                    ->label('No. Rekam Medis')
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(Pasien::class, 'no_rm', ignoreRecord: true)
                                    ->placeholder('Akan dibuat otomatis'),
                                Forms\Components\TextInput::make('nama')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('tgl_lahir')
                                    ->label('Tanggal Lahir')
                                    ->required(),
                                Forms\Components\TextInput::make('no_bpjs')
                                    ->label('No. BPJS (Jika ada)')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('alamat')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\Radio::make('jk')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ])
                                    ->required(),
                            ])
                            ->createOptionAction(fn (Forms\Components\Actions\Action $action) => $action->modalWidth('3xl')),
                        
                        Forms\Components\Select::make('poli_id')
                            ->label('Tujuan Poli')
                            ->options(Poli::all()->pluck('nama_poli', 'id'))
                            ->live() // <-- Penting untuk filter dokter
                            ->required(),

                        Forms\Components\Select::make('dokter_id')
                            ->label('Dokter')
                            // Opsi dokter akan di-filter berdasarkan poli_id yang dipilih
                            ->options(function (Get $get): Collection {
                                $poliId = $get('poli_id');
                                if (!$poliId) {
                                    return collect();
                                }
                                return User::where('role', 'dokter')
                                    ->where('poli_id', $poliId)
                                    ->pluck('name', 'id');
                            })
                            ->required(),
                        
                        Forms\Components\Select::make('status')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Diperiksa' => 'Diperiksa',
                                'Selesai' => 'Selesai',
                            ])
                            ->default('Menunggu')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.no_rm')
                    ->label('No. RM')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Nama Pasien')
                    ->searchable(),
                Tables\Columns\TextColumn::make('poli.nama_poli')
                    ->label('Tujuan Poli')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dokter.name')
                    ->label('Dokter')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Diperiksa' => 'info',
                        'Selesai' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Daftar')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc') // Tampilkan yang terbaru di atas
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([ // <-- TOMBOL BARU DITAMBAHKAN DI SINI
                Tables\Actions\Action::make('export')
                    ->label('Export Laporan (CSV)')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        return static::exportCsv($livewire->getFilteredTableQuery());
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Fungsi custom untuk handle logic export ke CSV.
     */
    public static function exportCsv(Builder $query): StreamedResponse
    {
        $fileName = 'laporan-pendaftaran-' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');

            // Header CSV
            fputcsv($handle, [
                'No RM',
                'Nama Pasien',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Poli Tujuan',
                'Dokter',
                'Status',
                'Waktu Pendaftaran',
            ]);

            // Data Pendaftaran
            $query->with(['pasien', 'poli', 'dokter'])->chunk(200, function ($pendaftarans) use ($handle) {
                foreach ($pendaftarans as $pendaftaran) {
                    fputcsv($handle, [
                        $pendaftaran->pasien->no_rm ?? '-',
                        $pendaftaran->pasien->nama ?? '-',
                        $pendaftaran->pasien->tgl_lahir ?? '-',
                        $pendaftaran->pasien->jk ?? '-',
                        $pendaftaran->poli->nama_poli ?? '-',
                        $pendaftaran->dokter->name ?? '-',
                        $pendaftaran->status,
                        $pendaftaran->created_at->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($handle);
        }, $fileName);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
