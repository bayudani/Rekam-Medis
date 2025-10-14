<?php

namespace App\Filament\Admin\Resources\RekamMedisResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pendaftaran;

class CatatanPerkembanganRelationManager extends RelationManager
{
    protected static string $relationship = 'catatanPerkembangans';

    protected static ?string $title = 'Catatan Perkembangan Pasien Terintegrasi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('hasil_pemeriksaan')
                    ->label('Hasil Pemeriksaan, Analisis, Rencana (SOAP)')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('instruksi_ppa')
                    ->label('Instruksi PPA')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal / Jam')
                    ->dateTime('d M Y, H:i'),
                Tables\Columns\TextColumn::make('ppa.name')
                    ->label('Profesional Pemberi Asuhan (PPA)'),
                Tables\Columns\TextColumn::make('hasil_pemeriksaan')
                    ->label('Hasil Pemeriksaan (SOAP)')
                    ->wrap()
                    ->limit(50),
                Tables\Columns\TextColumn::make('instruksi_ppa')
                    ->label('Instruksi PPA')
                    ->wrap()
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Catatan Baru')
                    ->mutateFormDataUsing(function (array $data): array {
                        // Otomatis isi user_id dengan user yang sedang login
                        $data['user_id'] = auth()->id();
                        return $data;
                    }),
                // --- INI DIA TOMBOL BARUNYA ---
                Tables\Actions\Action::make('cetakCatatanPdf')
                    ->label('Cetak Catatan (PDF)')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->action(function () {
                        // Ambil data Pendaftaran (induk dari relasi ini)
                        $pendaftaran = $this->getOwnerRecord();
                        
                        // Load view, kasih data, terus jadiin PDF
                        $pdf = Pdf::loadView('pdf.catatan_perkembangan', ['record' => $pendaftaran]);
                        
                        // Buat nama file
                        $filename = 'CPPT_' . $pendaftaran->pasien?->no_rm . '_' . now()->format('Ymd') . '.pdf';

                        // Langsung download!
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            $filename
                        );
                    })
                    ->openUrlInNewTab(),
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
}
