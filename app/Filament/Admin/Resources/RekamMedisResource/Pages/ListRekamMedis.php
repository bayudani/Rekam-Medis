<?php

namespace App\Filament\Admin\Resources\RekamMedisResource\Pages;

use App\Filament\Admin\Resources\RekamMedisResource;
use App\Models\Pendaftaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder; 


class ListRekamMedis extends ListRecords
{
    protected static string $resource = RekamMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $user = auth()->user();
        // Pastikan user ada dan rolenya dokter
        if (!$user || $user->role !== 'dokter') {
            return [];
        }

        // Query dasar untuk menghitung badge
        $baseQuery = Pendaftaran::where('poli_id', $user->poli_id);

        return [
            'semua' => Tab::make('Semua Pasien'),
            'menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Menunggu'))
                ->badge($baseQuery->clone()->where('status', 'Menunggu')->count())
                ->badgeColor('warning'),
            'diperiksa' => Tab::make('Sedang Diperiksa')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Diperiksa'))
                ->badge($baseQuery->clone()->where('status', 'Diperiksa')->count())
                ->badgeColor('info'),
            'selesai' => Tab::make('Selesai')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Selesai'))
                ->badge($baseQuery->clone()->where('status', 'Selesai')->count())
                ->badgeColor('success'),
        ];
    }
}
