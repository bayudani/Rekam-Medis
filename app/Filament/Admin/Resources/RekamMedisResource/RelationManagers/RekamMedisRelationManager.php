<?php

namespace App\Filament\Admin\Resources\RekamMedisResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Get;

class RekamMedisRelationManager extends RelationManager
{
    protected static string $relationship = 'rekamMedis';

    protected static ?string $title = 'Formulir Triase Pasien Gawat Darurat';

    public static function canViewForRecord(Model $ownerRecord, string $pageName): bool
    {
        return $ownerRecord->poli?->nama_poli === 'Ruang Tindakan';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kedatangan')
                    ->columns(4)
                    ->schema([
                        Forms\Components\CheckboxList::make('cara_datang')
                            ->options([
                                'Sendiri' => 'Sendiri',
                                'Diantar Keluarga' => 'Diantar Keluarga',
                                'Pustu/Poskesdes/Polindes' => 'Pustu/Poskesdes/Polindes',
                                'Dokter Luar' => 'Dokter Luar',
                                'Kecelakaan' => 'Kecelakaan',
                                'Diantar Polisi' => 'Diantar Polisi',
                                'Bidan' => 'Bidan',
                                'Tanpa Idenentitas' => 'Tanpa Identitas', // Typo 'Idenentitas' dari kode asli
                                'Lain-lain' => 'Lain-lain',
                            ])->columnSpan(2),
                        Forms\Components\CheckboxList::make('penanggung_jawab_biaya')
                            ->label('Penanggung Jawab Biaya')
                            ->options([
                                'BPJS/KIS' => 'BPJS/KIS',
                                'Jampersal' => 'Jampersal',
                                'Askes/Swasta' => 'Askes/Swasta', // Sesuai gambar
                                'KK/KTP' => 'KK/KTP',
                                'Umum' => 'Umum'
                            ])->columnSpan(2),
                        Forms\Components\DatePicker::make('tanggal_datang')->default(now())->required(),
                        Forms\Components\TimePicker::make('jam_datang')->default(now())->required(),
                        Forms\Components\TimePicker::make('jam_diperiksa'),
                        Forms\Components\TimePicker::make('jam_doa')->label('Jam DOA (Jika Perlu)'),
                        Forms\Components\Toggle::make('doa')
                            ->label('Status DOA (Meninggal saat tiba)')
                            ->inline(false),
                        Forms\Components\Textarea::make('riwayat_alergi')->columnSpanFull(),
                        Forms\Components\CheckboxList::make('tanda_kehidupan_negatif')
                            ->label('Tanda Kehidupan (-)')
                            ->options([
                                'Denyut Nadi (-)' => 'Denyut Nadi (-)',
                                'Respirasi (-)' => 'Respirasi (-)',
                                'Pupil dilatasi maksimal' => 'Pupil dilatasi maksimal',
                            ])->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Kondisi Awal Pasien')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Textarea::make('riwayat_penyakit_dahulu')->columnSpan(2),
                        Forms\Components\Toggle::make('trauma')->inline(false),
                        Forms\Components\Textarea::make('keluhan_utama')->columnSpanFull(), // Tambahan dari gambar
                        Forms\Components\Radio::make('kondisi')->options([
                            'Gawat Darurat' => 'Gawat Darurat',
                            'Darurat' => 'Darurat',
                            'Tidak Gawat Tidak Darurat' => 'Tidak Gawat Tidak Darurat',
                            'Meninggal' => 'Meninggal',
                        ])->columnSpanFull()->required(),
                    ]),

                // === BAGIAN YANG DIPERBAIKI ===
                Forms\Components\Section::make('Initial Assessment & Triase Primer')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Fieldset::make('Initial Assessment')
                            ->schema([
                                // FIX 1: Ganti TextInput jadi Radio/ToggleButtons
                                Forms\Components\Radio::make('pupil')
                                    ->label('Pupil')
                                    ->options([
                                        'isokor' => 'Isokor',
                                        'anisokor' => 'Anisokor',
                                    ])
                                    ->inline(),

                                // FIX 2: Ganti gcs_awal jadi 3 field terpisah (sesuai DB & Gambar)
                                Forms\Components\Fieldset::make('GCS')
                                    ->label('GCS (Eye, Verbal, Motorik)')
                                    ->schema([
                                        Forms\Components\Select::make('gcs_e')
                                            ->label('E')
                                            ->options(array_combine(range(4, 1), range(4, 1)))
                                            ->native(false),
                                        Forms\Components\Select::make('gcs_v')
                                            ->label('V')
                                            ->options(array_combine(range(5, 1), range(5, 1)))
                                            ->native(false),
                                        Forms\Components\Select::make('gcs_m')
                                            ->label('M')
                                            ->options(array_combine(range(6, 1), range(6, 1)))
                                            ->native(false),
                                    ])->columns(3),

                                Forms\Components\TextInput::make('refleks_cahaya'),

                                // FIX 3: Ganti opsi 'pemeriksaan_awal' dengan item 'Disability'
                                Forms\Components\CheckboxList::make('pemeriksaan_awal')
                                    ->label('Pemeriksaan (Disability)') // Gue ganti label biar jelas
                                    ->options([
                                        'GCS < 9' => 'GCS < 9',
                                        'Kejang' => 'Kejang',
                                        'Unresponsive' => 'Unresponsive',
                                    ]),
                            ]),
                        Forms\Components\Fieldset::make('Triase Primer')
                            ->schema([
                                // Ini adalah item Airway, Breathing, Circulation.
                                // Sesuai kode asli, ini disimpan di 'resusitasi'
                                Forms\Components\CheckboxList::make('resusitasi')
                                    ->label('Pemeriksaan (Airway, Breathing, Circulation)')
                                    ->options([
                                        'Sumbatan' => 'Sumbatan',
                                        'Henti Napas' => 'Henti Napas',
                                        'Bradipnoe' => 'Bradipnoe',
                                        'Sianosis' => 'Sianosis',
                                        'Henti Jantung' => 'Henti Jantung',
                                        'Nadi tidak teraba' => 'Nadi tidak teraba',
                                        'Akral dingin' => 'Akral dingin'
                                    ])->columns(2), // Biar rapi

                                // FIX 4: Ganti 'GCS < 9' jadi 'GCS 9 - 12'
                                Forms\Components\CheckboxList::make('emergency')
                                    ->label('Emergency (Kotak Kuning)')
                                    ->options([
                                        'Bebas' => 'Bebas',
                                        'Ancaman' => 'Ancaman',
                                        'Takipnoe (>32x/mnt)' => 'Takipnoe (>32x/mnt)',
                                        'Mengi' => 'Mengi',
                                        'Nadi teraba lemah' => 'Nadi teraba lemah',
                                        'Bradikardi' => 'Bradikardi',
                                        'Takikardi (120-150x/mnt)' => 'Takikardi (120-150x/mnt)',
                                        'Pucat' => 'Pucat',
                                        'Akral dingin' => 'Akral dingin',
                                        'CRT > 2 detik' => 'CRT > 2 detik',
                                        'GCS 9 - 12' => 'GCS 9 - 12', // INI YANG DIPERBAIKI
                                        'Gelisah' => 'Gelisah',
                                        'Nyeri Dada' => 'Nyeri Dada'
                                    ])->columns(2), // Biar rapi
                            ]),
                    ]),
                // === AKHIR BAGIAN YANG DIPERBAIKI ===

                Forms\Components\Section::make('Triase Sekunder')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Urgent')
                            ->schema([
                                Forms\Components\CheckboxList::make('urgent')
                                    ->label(false)
                                    // === FIX DI SINI: Key dan Value harus sama (teks) ===
                                    ->options([
                                        'Normal' => 'Normal',
                                        'Mengi' => 'Mengi',
                                        'Takipnoe' => 'Takipnoe',
                                        'Nadi Kuat' => 'Nadi Kuat',
                                        'Takikardi' => 'Takikardi',
                                        'GCS > 12' => 'GCS > 12',
                                        'Apatis' => 'Apatis',
                                        'Somnolen' => 'Somnolen',
                                        '38-39.9 °C' => '38-39.9 °C'
                                    ]),
                            ]),
                        Forms\Components\Fieldset::make('Non Urgent')
                            ->schema([
                                Forms\Components\CheckboxList::make('non_urgent')
                                    ->label(false)
                                    // === FIX DI SINI: Key dan Value harus sama (teks) ===
                                    ->options([
                                        'Normal' => 'Normal',
                                        'Nadi Kuat' => 'Nadi Kuat',
                                        'Frek Normal' => 'Frek Normal',
                                        'GCS 15' => 'GCS 15',
                                        '< 38 °C' => '< 38 °C' // Value untuk cek di PDF
                                    ]),
                            ]),
                        Forms\Components\Fieldset::make('False Emergency')
                            ->schema([
                                Forms\Components\CheckboxList::make('false_emergency')
                                    ->label(false)
                                    // === FIX DI SINI: Key dan Value harus sama (teks) ===
                                    ->options([
                                        'Normal' => 'Normal',
                                        'Nadi Kuat' => 'Nadi Kuat',
                                        'Frek Normal' => 'Frek Normal',
                                        'GCS 15' => 'GCS 15',
                                        '< 38 °C' => '< 38 °C' // Value untuk cek di PDF
                                    ]),
                            ]),
                    ]),

                Forms\Components\Section::make('Tanda Vital & Keadaan Umum')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('keadaan_umum'), // Tambahan dari gambar
                        Forms\Components\TextInput::make('kesadaran'),
                        Forms\Components\Fieldset::make('Tanda Vital')
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('td')->label('TD')->suffix('mmHg'),
                                Forms\Components\TextInput::make('hr')->label('HR')->suffix('x/mnt'),
                                Forms\Components\TextInput::make('rr')->label('RR')->suffix('x/mnt'),
                                Forms\Components\TextInput::make('t')->label('T')->suffix('°C'),
                                Forms\Components\TextInput::make('bb')->label('BB')->suffix('kg'),
                                Forms\Components\TextInput::make('tb')->label('TB')->suffix('cm'),
                            ]),
                        // FIX 5: Ganti nama field 'skala_nyeri' jadi 'ada_keluhan_nyeri' (sesuai DB)
                        Forms\Components\ToggleButtons::make('ada_keluhan_nyeri')
                            ->label('Apakah terdapat keluhan nyeri?')
                            ->options(['0' => 'Tidak', '1' => 'Ya'])
                            ->inline()->boolean()->live(),
                        Forms\Components\Select::make('skor_nyeri')
                            ->label('Skor Nyeri (0-10)')
                            ->options(array_combine(range(0, 10), range(0, 10)))
                            ->visible(fn(Forms\Get $get) => $get('ada_keluhan_nyeri')), // Disesuaikan
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pendaftaran_id')
                    ->label('Pendaftaran ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kondisi')
                    ->label('Kondisi Pasien')
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        'Gawat Darurat' => 'danger',
                        'Darurat' => 'warning',
                        'Tidak Gawat Tidak Darurat' => 'success',
                        'Meninggal' => 'gray',
                        default => 'primary',
                    })
                    ->default('Belum Dinilai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_datang')
                    ->label('Tanggal Datang')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_datang')
                    ->label('Jam Datang'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Formulir Triase')
                    ->icon('heroicon-o-plus-circle')
                    ->modalHeading('Formulir Triase Pasien Gawat Darurat')
                    ->modalWidth('7xl'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Detail Formulir Triase')
                    ->modalWidth('7xl'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->modalHeading('Edit Formulir Triase')
                    ->modalWidth('7xl'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
