<?php

namespace App\Filament\Admin\Resources\RekamMedisResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RekamMedisRelationManager extends RelationManager
{
    protected static string $relationship = 'rekamMedis';

    protected static ?string $title = 'Formulir Triase Pasien Gawat Darurat';

    
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
                                'Diantar Polisi' => 'Diantar Polisi',
                                'Bidan' => 'Bidan',
                            ])->columnSpan(2),
                        Forms\Components\CheckboxList::make('penanggung_jawab_biaya')
                            ->label('Penanggung Jawab Biaya')
                            ->options([
                                'BPJS/KIS' => 'BPJS/KIS',
                                'Jampersal' => 'Jampersal',
                                'KK/KTP' => 'KK/KTP',
                                'Umum' => 'Umum'
                            ])->columnSpan(2),
                        Forms\Components\DatePicker::make('tanggal_datang')->default(now())->required(),
                        Forms\Components\TimePicker::make('jam_datang')->default(now())->required(),
                        Forms\Components\TimePicker::make('jam_diperiksa'),
                        Forms\Components\TimePicker::make('jam_doa')->label('Jam DOA (Jika Perlu)'),
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
                        Forms\Components\Radio::make('kondisi')->options([
                            'Gawat Darurat' => 'Gawat Darurat',
                            'Darurat' => 'Darurat',
                            'Tidak Gawat Tidak Darurat' => 'Tidak Gawat Tidak Darurat',
                            'Meninggal' => 'Meninggal',
                        ])->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Initial Assessment & Triase Primer')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Fieldset::make('Initial Assessment')
                            ->schema([
                                Forms\Components\TextInput::make('pupil')->label('Pupil: isokhor/anisokhor'),
                                Forms\Components\TextInput::make('gcs_awal')->label('GCS (Eye, Verbal, Motorik)'),
                                Forms\Components\TextInput::make('refleks_cahaya'),
                                Forms\Components\CheckboxList::make('pemeriksaan_awal')
                                    ->label('Pemeriksaan')
                                    ->options([
                                        'Airway & C. Spine Control' => 'Airway & C. Spine Control',
                                        'Breathing' => 'Breathing',
                                        'Circulation' => 'Circulation',
                                        'Disability' => 'Disability',
                                    ]),
                            ]),
                        Forms\Components\Fieldset::make('Triase Primer')
                            ->schema([
                                Forms\Components\CheckboxList::make('resusitasi')
                                    ->options(['Sumbatan', 'Henti Napas', 'Bradipnoe', 'Sianosis', 'Henti Jantung', 'Nadi tidak teraba', 'Akral dingin']),
                                Forms\Components\CheckboxList::make('emergency')
                                    ->label('Emergency')
                                    ->options(['Bebas', 'Ancaman', 'Takipnoe (>32x/mnt)', 'Mengi', 'Nadi teraba lemah', 'Bradikardi', 'Takikardi (120-150x/mnt)', 'Pucat', 'Akral dingin', 'CRT > 2 detik', 'GCS < 9', 'Gelisah', 'Nyeri Dada']),
                            ]),
                    ]),
                
                Forms\Components\Section::make('Triase Sekunder')
                    ->columns(3)
                    ->schema([
                         Forms\Components\Fieldset::make('Urgent')
                            ->schema([
                                Forms\Components\CheckboxList::make('urgent')
                                    ->label(false) // Sembunyikan label karena sudah ada di Fieldset
                                    ->options(['Normal', 'Mengi', 'Takipnoe', 'Nadi Kuat', 'Takikardi', 'GCS > 12', 'Apatis', 'Somnolen', '38-39.9 °C']),
                            ]),
                        Forms\Components\Fieldset::make('Non Urgent')
                            ->schema([
                                Forms\Components\CheckboxList::make('non_urgent')
                                     ->label(false)
                                    ->options(['Normal', 'Nadi Kuat', 'Frek Normal', 'GCS 15']),
                            ]),
                        Forms\Components\Fieldset::make('False Emergency')
                            ->schema([
                                Forms\Components\CheckboxList::make('false_emergency')
                                     ->label(false)
                                    ->options(['Normal', 'Nadi Kuat', 'Frek Normal', 'GCS 15', '< 38 °C']),
                            ]),
                    ]),

                Forms\Components\Section::make('Tanda Vital & Keadaan Umum')
                    ->columns(2)
                    ->schema([
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
                        Forms\Components\Toggle::make('ada_keluhan_nyeri')
                            ->label('Apakah terdapat keluhan nyeri?')
                            ->live()
                            ->inline(false),
                        Forms\Components\TextInput::make('skor_nyeri')
                            ->label('Bila Ya, berapa skala nyerinya?')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(10)
                            ->visible(fn (Forms\Get $get) => $get('ada_keluhan_nyeri')),
                    ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('pendaftaran_id')
            ->columns([
                // Tidak perlu kolom karena ini form 1-to-1
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Cek dulu apakah sudah ada datanya atau belum
                Tables\Actions\CreateAction::make()
                    ->label('Buat Rekam Medis Tindakan')
                    ->visible(fn (): bool => !$this->getOwnerRecord()->rekamMedis()->exists()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Sebaiknya tidak ada delete untuk rekam medis
            ])
            ->emptyStateHeading('Belum Ada Rekam Medis')
            ->emptyStateDescription('Buat rekam medis untuk pendaftaran ini.');
    }
}

