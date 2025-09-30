<?php

namespace App\Filament\Admin\Resources;

use App\Filament\admin\Resources\RekamMedisResource\Pages;
use App\Models\Pendaftaran;
use App\Models\Poli;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


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
        return auth()->user()->role === 'dokter';
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        return parent::getEloquentQuery()->where('poli_id', $user->poli_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Informasi Pasien')
                        ->schema([
                            Forms\Components\Placeholder::make('no_rm')
                                ->label('No. RM')
                                ->content(fn (?Pendaftaran $record): string => $record?->pasien?->no_rm ?? '-'),
                            Forms\Components\Placeholder::make('nama_pasien')
                                ->label('Nama Pasien')
                                ->content(fn (?Pendaftaran $record): string => $record?->pasien?->nama ?? '-'),
                            Forms\Components\Placeholder::make('no_bpjs')
                                ->label('NO BPJS')
                                ->content(fn (?Pendaftaran $record): string => $record?->pasien?->no_bpjs ?? '-'),
                            Forms\Components\Placeholder::make('jenis_kelamin')
                                ->label('Jenis Kelamin')
                                ->content(fn (?Pendaftaran $record): string => $record?->pasien?->jk === 'L' ? 'Laki-laki' : 'Perempuan'),
                            // Forms\Components\Placeholder::make('umur')
                            //     ->label('Tgl. Lahir / Umur')
                            //     ->content(function (?Pendaftaran $record): string {
                            //         if (!$record || !$record->pasien?->tgl_lahir) {
                            //             return '-';
                            //         }
                            //         $tgl_lahir = Carbon::parse($record->pasien->tgl_lahir);
                            //         return $tgl_lahir->format('d F Y') . ' (' . $tgl_lahir->age . ' Thn)';
                            //     }),
                        ])->columns(2),
                ])->columnSpan(1),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Status & Waktu Kunjungan')
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'Menunggu' => 'Menunggu',
                                    'Diperiksa' => 'Diperiksa',
                                    'Selesai' => 'Selesai'
                                ])
                                ->required(),
                            Forms\Components\DateTimePicker::make('tanggal_asesmen')
                                ->label('Waktu Asesmen')
                                ->default(now())
                                ->required(),
                        ]),
                ])->columnSpan(1),


                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Asesmen Keperawatan')
                        ->schema(self::getSkemaKeperawatan()),
                    Forms\Components\Wizard\Step::make('Asesmen Medis')
                        ->schema(self::getSkemaMedis()),
                    Forms\Components\Wizard\Step::make('Tindak Lanjut')
                        ->schema(self::getSkemaTindakLanjut()),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.no_rm')->label('No. RM')->searchable(),
                Tables\Columns\TextColumn::make('pasien.nama')->label('Nama Pasien')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Diperiksa' => 'info',
                        'Selesai' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Waktu Daftar')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Terakhir Diperiksa')->dateTime()->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Periksa'),
                Tables\Actions\Action::make('cetakPdf')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->action(function (Pendaftaran $record) {
                        // Tentukan view mana yang mau dipakai berdasarkan poli
                        $viewName = 'pdf.umum'; // Default ke umum
                        if ($record->poli?->nama_poli === 'Poli Gigi & Mulut') {
                            $viewName = 'pdf.gigi';
                        }

                        // Load view, kasih data, terus jadiin PDF
                        $pdf = Pdf::loadView($viewName, ['record' => $record]);
                        
                        // Buat nama file yang keren
                        $filename = 'RM_' . $record->pasien?->no_rm . '_' . now()->format('Ymd') . '.pdf';

                        // Langsung download!
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            $filename
                        );
                    })
                    ->openUrlInNewTab(), // Buka PDF di tab baru
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekamMedis::route('/'),
            'edit' => Pages\EditRekamMedis::route('/{record}/edit'),
        ];
    }

    // --- SKEMA FORM ---

    public static function getSkemaKeperawatan(): array
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
                    Forms\Components\TextInput::make('alergi_keterangan')->label('Sebutkan Alergi')->visible(fn (Forms\Get $get) => $get('ada_alergi')),
                    Forms\Components\CheckboxList::make('status_psikologis')
                        ->options(['Tenang' => 'Tenang', 'Cemas' => 'Cemas', 'Takut' => 'Takut', 'Marah' => 'Marah', 'Sedih' => 'Sedih', 'Cenderung Bunuh Diri' => 'Cenderung Bunuh Diri'])->columns(3),
                ])->columns(2),

            Forms\Components\Section::make('O (Objektif)')
                ->description('Diisi berdasarkan hasil pemeriksaan fisik oleh perawat/dokter')
                ->schema([
                    Forms\Components\Textarea::make('o_keperawatan')->label('Pemeriksaan Objektif Keperawatan'),
                    Forms\Components\Fieldset::make('Tanda-Tanda Vital (TTV)')
                        ->schema([
                            Forms\Components\TextInput::make('td')->label('TD (mmHg)'),
                            Forms\Components\TextInput::make('hr')->label('HR (x/mnt)'),
                            Forms\Components\TextInput::make('rr')->label('RR (x/mnt)'),
                            Forms\Components\TextInput::make('t')->label('T (°C)'),
                            Forms\Components\TextInput::make('spo2')->label('SpO₂ (%)'),
                            Forms\Components\TextInput::make('bb')->label('BB (kg)'),
                            Forms\Components\TextInput::make('tb')->label('TB (cm)'),
                            Forms\Components\TextInput::make('imt')->label('IMT'),
                            Forms\Components\TextInput::make('lingkar_perut')->label('Lingkar Perut (cm)'),
                            Forms\Components\TextInput::make('lingkar_kepala')->label('Lingkar Kepala (cm)'),
                            Forms\Components\TextInput::make('lila')->label('LILA (cm)'),
                        ])->columns(4),
                    Forms\Components\ToggleButtons::make('skala_nyeri')
                        ->label('Skala Nyeri')
                        ->options(['0' => 'Tidak', '1' => 'Ya'])
                        ->inline()->boolean()->live(),
                    Forms\Components\Select::make('skor_nyeri')->options(array_combine(range(0, 10), range(0, 10)))->visible(fn (Forms\Get $get) => $get('skala_nyeri')),
                    Forms\Components\Radio::make('status_fungsional')->options(['Mandiri' => 'Mandiri', 'Perlu Bantuan' => 'Perlu Bantuan', 'Ketergantungan total' => 'Ketergantungan total']),
                    Forms\Components\Fieldset::make('Risiko Jatuh')
                        ->schema([
                            Forms\Components\Checkbox::make('risiko_jatuh_penilaian_1')->label('Cara berjalan pasien (tidak seimbang/sempoyongan/limbung/menggunakan alat bantu)'),
                            Forms\Components\Checkbox::make('risiko_jatuh_penilaian_2')->label('Menopang saat akan duduk'),
                            // Hasil akan di-logic-kan nanti
                        ]),
                ]),

            Forms\Components\Section::make('A & P (Keperawatan)')
                ->schema([
                    Forms\Components\Textarea::make('a_keperawatan')->label('Assessment (A)'),
                    Forms\Components\Textarea::make('p_keperawatan')->label('Planning (P)'),
                ])->columns(1),
        ];
    }

    public static function getSkemaMedis(): array
    {
        $poliNama = auth()->user()->poli?->nama_poli;

        $skema = [
            Forms\Components\Textarea::make('anamnesis_medis')->label('Anamnesis (S)'),
        ];

        if ($poliNama === 'Poli Gigi & Mulut') {
            $skema[] = Forms\Components\Textarea::make('odontogram')->label('Odontogram (O)');
        } else {
            $skema[] = Forms\Components\Textarea::make('pemeriksaan_fisik_medis')->label('Pemeriksaan Fisik (O)');
            $skema[] = Forms\Components\Textarea::make('pemeriksaan_penunjang_medis')->label('Pemeriksaan Penunjang');
            $skema[] = Forms\Components\TextInput::make('laboratorium')->label('Laboratorium');
        }

        $skema = array_merge($skema, [
            Forms\Components\Textarea::make('assessment_diagnosa_medis')->label('Assessment/Diagnosa (A)')->required(),
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
}

