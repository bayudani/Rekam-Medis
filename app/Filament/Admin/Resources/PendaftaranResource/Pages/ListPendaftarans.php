<?php

namespace App\Filament\Admin\Resources\PendaftaranResource\Pages;

use App\Filament\Admin\Resources\PendaftaranResource;
use App\Models\Pendaftaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // tabs function
    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua Kunjungan'),
            'hari_ini' => Tab::make('Kunjungan Hari Ini')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereDate('created_at', today()))
                ->badge(Pendaftaran::query()->whereDate('created_at', today())->count())
                ->badgeColor('info'),
            'menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'Menunggu'))
                ->badge(Pendaftaran::query()->where('status', 'Menunggu')->count())
                ->badgeColor('warning'),
        ];
    }
}
