<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RekamMedisResource\Pages;
use App\Filament\Admin\Resources\RekamMedisResource\RelationManagers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Filament\Resources\Components\Tab;
use Filament\Forms\Set; // <-- Tambahin ini
use Filament\Forms\Get; // <-- Tambahin ini
use App\Forms\Components\ontodgram;


class RekamMedisResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationLabel = 'Rekam Medis Pasien';
    protected static ?string $slug = 'rekam-medis';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Rekam Medis';

    public static function canViewAny(): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }
        return $user->role === 'dokter';
    }


    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        return parent::getEloquentQuery()->where('poli_id', $user->poli_id);
    }

    // --- INI DIA BAGIAN YANG DI-UPGRADE TOTAL ---
    public static function form(Form $form): Form
    {
        return $form
            ->schema(function (?Pendaftaran $record): array {
                // Jika data belum ada (misal saat create, meskipun disembunyikan), jangan tampilkan apa-apa
                if (!$record) {
                    return [];
                }

                // Cek nama poli dari data pendaftaran yang sedang dibuka
                if ($record->poli?->nama_poli === 'Ruang Tindakan') {
                    // JIKA INI PASIEN RUANG TINDAKAN:
                    // Sembunyikan form wizard dan biarkan Relation Manager yang bekerja.
                    // Cukup tampilkan info pasien & status.
                    return [
                        Forms\Components\Group::make()->schema([
                            Forms\Components\Section::make('Informasi Pasien')
                                ->schema(self::getSkemaInfoPasien()), // Panggil skema info pasien
                        ])->columnSpan(1),

                        Forms\Components\Group::make()->schema([
                            Forms\Components\Section::make('Status & Waktu Kunjungan')
                                ->schema(self::getSkemaStatusKunjungan()), // Panggil skema status
                        ])->columnSpan(1),


                        // Wizard disembunyikan di sini
                    ];
                }

                // JIKA BUKAN PASIEN RUANG TINDAKAN (PASIEN BIASA):
                // Tampilkan form Wizard lengkap seperti sebelumnya.
                return [
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Informasi Pasien')
                            ->schema(self::getSkemaInfoPasien()),
                    ])->columnSpan(1),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Status & Waktu Kunjungan')
                            ->schema(self::getSkemaStatusKunjungan()),
                    ])->columnSpan(1),

                    Forms\Components\Wizard::make([
                        Forms\Components\Wizard\Step::make('Asesmen Keperawatan')
                            ->schema(self::getSkemaKeperawatan($record)), // DIUBAH: Kirim $record ke skema keperawatan
                        Forms\Components\Wizard\Step::make('Asesmen Medis')
                            ->schema(function () use ($record) { // Dibuat dinamis di sini
                                return self::getSkemaMedis($record);
                            }),
                        Forms\Components\Wizard\Step::make('Tindak Lanjut')
                            ->schema(self::getSkemaTindakLanjut()),
                    ])->columnSpanFull(),
                ];
            })->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.no_rm')->label('No. RM')->searchable(),
                Tables\Columns\TextColumn::make('pasien.nama')->label('Nama Pasien')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Diperiksa' => 'info',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Waktu Daftar')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Terakhir Diperiksa')->dateTime()->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                // filter by status
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Diperiksa' => 'Diperiksa',
                        'Selesai' => 'Selesai',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Periksa'),
                Tables\Actions\Action::make('cetakPdf')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    // Sembunyikan tombol cetak untuk Ruang Tindakan (karena templatenya belum dibuat)
                    ->visible(fn(Pendaftaran $record) => $record->poli?->nama_poli !== 'Ruang Tindakan')
                    ->action(function (Pendaftaran $record) {
                        $viewName = 'pdf.umum';
                        if ($record->poli?->nama_poli === 'Poli Gigi & Mulut') {
                            $viewName = 'pdf.gigi';
                        }
                        $dokter = auth()->user();
                        $pdf = Pdf::loadView($viewName, [
                            'record' => $record,
                            'dokter' => $dokter,
                        ]);
                        $filename = 'RM_' . $record->pasien?->no_rm . '_' . now()->format('Ymd') . '.pdf';
                        return response()->streamDownload(fn() => print($pdf->output()), $filename);
                    })
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('cetakTindakanPdf')
                    ->label('Cetak PDF Tindakan')
                    ->icon('heroicon-o-printer')
                    ->color('danger')
                    ->visible(fn(Pendaftaran $record) => $record->poli?->nama_poli === 'Ruang Tindakan')
                    ->action(function (Pendaftaran $record) {
                        // Cek apakah ada data rekam medis (ambil yang pertama/terbaru)
                        $rekamMedis = $record->rekamMedis()->first();

                        if (!$rekamMedis) {
                            \Filament\Notifications\Notification::make()
                                ->title('Data Belum Lengkap')
                                ->body('Formulir Triase Gawat Darurat belum diisi.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $pdf = Pdf::loadView('pdf.tindakan', ['record' => $record]);
                        $filename = 'RM_Tindakan_' . $record->pasien?->no_rm . '_' . now()->format('Ymd') . '.pdf';
                        return response()->streamDownload(fn() => print($pdf->output()), $filename);
                    })
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([]);
    }


    public static function getRelations(): array
    {
        return [
            // Daftarkan Relation Manager di sini agar bisa dipanggil
            RelationManagers\RekamMedisRelationManager::class,
            RelationManagers\CatatanPerkembanganRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekamMedis::route('/'),
            'edit' => Pages\EditRekamMedis::route('/{record}/edit'),
        ];
    }

    // --- SKEMA FORM DIPISAH BIAR RAPI ---

    public static function getSkemaInfoPasien(): array
    {
        return [
            Forms\Components\Placeholder::make('no_rm')
                ->label('No. RM')
                ->content(fn(?Pendaftaran $record): string => $record?->pasien?->no_rm ?? '-'),
            Forms\Components\Placeholder::make('nama_pasien')
                ->label('Nama Pasien')
                ->content(fn(?Pendaftaran $record): string => $record?->pasien?->nama ?? '-'),
            Forms\Components\Placeholder::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->content(fn(?Pendaftaran $record): string => $record?->pasien?->jk === 'L' ? 'Laki-laki' : 'Perempuan'),
            Forms\Components\Placeholder::make('umur')
                ->label('Tgl. Lahir / Umur')
                ->content(function (?Pendaftaran $record): string {
                    if (!$record || !$record->pasien?->tgl_lahir) return '-';
                    $tgl_lahir = Carbon::parse($record->pasien->tgl_lahir);
                    return $tgl_lahir->format('d F Y') . ' (' . $tgl_lahir->age . ' Thn)';
                }),
        ];
    }

    public static function getSkemaStatusKunjungan(): array
    {
        return [
            Forms\Components\Select::make('status')
                ->options(['Menunggu' => 'Menunggu', 'Diperiksa' => 'Diperiksa', 'Selesai' => 'Selesai'])
                ->required(),
            Forms\Components\DateTimePicker::make('tanggal_asesmen')
                ->label('Waktu Asesmen')
                ->default(now())
                ->required(),
        ];
    }

    // DIUBAH: Tambahkan parameter $record
    public static function getSkemaKeperawatan(?Pendaftaran $record): array
    {
        return [
            Forms\Components\Section::make('S (Subjektif)')
                ->description('Diisi berdasarkan anamnesis atau keluhan pasien')
                ->schema([
                    Forms\Components\CheckboxList::make('hambatan_pelayanan')
                        ->label('Hambatan Pelayanan')
                        ->options(['Bahasa' => 'Bahasa', 'Fisik' => 'Fisik', 'Tuli' => 'Tuli', 'Bisu' => 'Bisu', 'Buta' => 'Buta'])->columns(5),
                    Forms\Components\Radio::make('status_sosial')->options(['Menikah' => 'Menikah', 'Belum Menikah' => 'Belum Menikah', 'Cerai' => 'Cerai'])->inline(),
                    Forms\Components\CheckboxList::make('riwayat_kesehatan')
                        ->options(['Hipertensi' => 'Hipertensi', 'Jantung' => 'Jantung', 'Diabetes' => 'Diabetes', 'TB Paru' => 'TB Paru'])
                        ->columns(4),
                    Forms\Components\TextInput::make('riwayat_kesehatan_lainnya')->label('Lain-lain'),
                    Forms\Components\CheckboxList::make('kebiasaan')
                        ->options(['Rokok' => 'Rokok', 'Alkohol' => 'Alkohol', 'Obat Tidur' => 'Obat Tidur', 'Olahraga' => 'Olahraga'])->columns(4),
                    Forms\Components\ToggleButtons::make('ada_alergi')
                        ->label('Alergi')
                        ->options(['0' => 'Tidak', '1' => 'Ya'])
                        ->inline()->boolean()->live(),
                    Forms\Components\TextInput::make('alergi_keterangan')->label('Sebutkan Alergi')->visible(fn(Forms\Get $get) => $get('ada_alergi')),
                    Forms\Components\CheckboxList::make('status_psikologis')
                        ->options(['Tenang' => 'Tenang', 'Cemas' => 'Cemas', 'Takut' => 'Takut', 'Marah' => 'Marah', 'Sedih' => 'Sedih', 'Cenderung Bunuh Diri' => 'Cenderung Bunuh Diri'])->columns(3),
                ])->columns(2),

            Forms\Components\Section::make('O (Objektif)')
                ->description('Diisi berdasarkan hasil pemeriksaan fisik oleh perawat/dokter')
                ->schema([
                    Forms\Components\Textarea::make('o_keperawatan')->label('Pemeriksaan Objektif Keperawatan'),
                    Forms\Components\Fieldset::make('Tanda-Tanda Vital (TTV)')
                        ->schema([
                            Forms\Components\TextInput::make('td')->label('TD (mmHg)')->suffix('mmHg'),
                            Forms\Components\TextInput::make('hr')->label('HR (x/mnt)')->suffix('x/mnt'),
                            Forms\Components\TextInput::make('rr')->label('RR (x/mnt)')->suffix('x/mnt'),
                            Forms\Components\TextInput::make('t')->label('T (°C)')->suffix('°C'),
                            Forms\Components\TextInput::make('spo2')->label('SpO₂ (%)')->suffix('%'),
                            Forms\Components\TextInput::make('bb')->label('BB (kg)')->suffix('kg'),
                            Forms\Components\TextInput::make('tb')->label('TB (cm)')->suffix('cm'),
                            Forms\Components\TextInput::make('imt')->label('IMT')->suffix('kg/m²'),
                            Forms\Components\TextInput::make('lingkar_perut')->label('Lingkar Perut (cm)')->suffix('cm'),
                            // DIUBAH: Logika visible untuk lingkar_kepala
                            Forms\Components\TextInput::make('lingkar_kepala')
                                ->label('(Usia 0 - 59 bulan) Lingkar Kepala') // Label sedikit diubah
                                ->suffix('cm')
                                ->visible(function () use ($record): bool { // Gunakan closure dan $record
                                    if (!$record || !$record->pasien?->tgl_lahir) {
                                        return false; // Sembunyikan jika data tidak ada
                                    }
                                    // Hitung umur dalam bulan
                                    $tglLahir = Carbon::parse($record->pasien->tgl_lahir);
                                    $umurBulan = $tglLahir->diffInMonths(now());
                                    // Tampilkan jika umur >= 0 dan <= 59 bulan
                                    return $umurBulan >= 0 && $umurBulan <= 59;
                                }),
                            Forms\Components\TextInput::make('lila')->label('LILA (cm)'),
                        ])->columns(4),
                    Forms\Components\ToggleButtons::make('skala_nyeri')
                        ->label('Skala Nyeri')
                        ->options(['0' => 'Tidak', '1' => 'Ya'])
                        ->inline()->boolean()->live(),
                    Forms\Components\Select::make('skor_nyeri')->options(array_combine(range(0, 10), range(0, 10)))->visible(fn(Forms\Get $get) => $get('skala_nyeri')),
                    Forms\Components\Radio::make('status_fungsional')->options(['Mandiri' => 'Mandiri', 'Perlu Bantuan' => 'Perlu Bantuan', 'Ketergantungan total' => 'Ketergantungan total']),
                    Forms\Components\Fieldset::make('Risiko Jatuh')
                        ->schema([
                            Forms\Components\Checkbox::make('risiko_jatuh_penilaian_1')
                                ->label('Cara berjalan pasien (tidak seimbang/sempoyongan/limbung/menggunakan alat bantu)')
                                ->live() // <-- Bikin jadi interaktif
                                ->afterStateUpdated(fn(Set $set, Get $get) => self::hitungRisikoJatuh($set, $get)),

                            Forms\Components\Checkbox::make('risiko_jatuh_penilaian_2')
                                ->label('Menopang saat akan duduk')
                                ->live() // <-- Bikin jadi interaktif
                                ->afterStateUpdated(fn(Set $set, Get $get) => self::hitungRisikoJatuh($set, $get)),

                            // Field untuk nampilin hasilnya, dibikin disabled
                            Forms\Components\TextInput::make('risiko_jatuh_hasil')
                                ->label('Hasil Penilaian')
                                ->disabled()
                                ->dehydrated(),
                        ]),
                ]),

            Forms\Components\Section::make('A & P (Keperawatan)')
                ->schema([
                    Forms\Components\Textarea::make('a_keperawatan')->label('Assessment (A)'),
                    Forms\Components\Textarea::make('p_keperawatan')->label('Planning (P)'),
                ])->columns(1),
        ];
    }

    // Penentuan skema medis sekarang menerima record
    public static function getSkemaMedis(?Pendaftaran $record): array
    {
        $poliNama = $record->poli?->nama_poli;

        $skema = [
            Forms\Components\Textarea::make('anamnesis_medis')->label('Anamnesis (S)'),
        ];

        if ($poliNama === 'Poli Gigi & Mulut') {
            $skema[] =  ontodgram::make('odontogram');
        } else {
            $skema[] = Forms\Components\Textarea::make('pemeriksaan_fisik_medis')->label('Pemeriksaan Fisik (O)');
            $skema[] = Forms\Components\Textarea::make('pemeriksaan_penunjang_medis')->label('Pemeriksaan Penunjang');
            $skema[] = Forms\Components\TextInput::make('laboratorium')->label('Laboratorium');
        }

        $skema = array_merge($skema, [
            Forms\Components\Textarea::make('assessment_diagnosa_medis')->label('Assessment/Diagnosa (A)'),
            Forms\Components\TextInput::make('icd_x')->label('ICD X'),
            Forms\Components\Textarea::make('rencana_terapi_medis')->label('Rencana Terapi/Planning (P)'),
        ]);

        return $skema;
    }

    public static function getSkemaTindakLanjut(): array
    {
        return [
            Forms\Components\CheckboxList::make('rujuk_internal')
                ->label('Rujuk Internal')
                ->options(['Gizi' => 'Gizi', 'R. Tindakan' => 'R. Tindakan', 'VCT/IMS' => 'VCT/IMS', 'Lain-lain' => 'Lain-lain']),
            Forms\Components\CheckboxList::make('rujuk_eksternal')
                ->label('Rujuk Eksternal')
                ->options(['RSUD Bengkalis' => 'RSUD Bengkalis']),
        ];
    }

    public static function hitungRisikoJatuh(Set $set, Get $get): void
    {
        $skor = 0;
        if ($get('risiko_jatuh_penilaian_1')) {
            $skor++;
        }
        if ($get('risiko_jatuh_penilaian_2')) {
            $skor++;
        }

        $hasil = 'Tidak Berisiko';
        if ($skor === 1) {
            $hasil = 'Risiko Rendah';
        } elseif ($skor === 2) {
            $hasil = 'Risiko Tinggi';
        }

        // Update isi field 'risiko_jatuh_hasil'
        $set('risiko_jatuh_hasil', $hasil);
    }
}
