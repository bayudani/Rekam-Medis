<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\PendaftaranResource;
use App\Filament\Admin\Resources\RekamMedisResource;
use App\Models\pasien;
use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $stats = [];

        // JIKA YANG LOGIN ADALAH DOKTER
        if ($user && $user->role === 'dokter') {
            $baseQuery = Pendaftaran::where('poli_id', $user->poli_id);

            $stats = [
                Stat::make('Total Pasien Poli Ini', $baseQuery->count())
                    ->description('Jumlah semua pasien di poli Anda')
                    ->descriptionIcon('heroicon-m-user-group')
                    ->color('success')
                    ->url(route('filament.admin.resources.rekam-medis.index')),

                Stat::make('Pasien Selesai', $baseQuery->clone()->where('status', 'Selesai')->count())
                    ->description('Jumlah pasien yang telah diperiksa')
                    ->descriptionIcon('heroicon-m-check-badge')
                    ->color('info')
                    ->url(RekamMedisResource::getUrl('index', ['activeTab' => 'selesai'])),

                Stat::make('Pasien Menunggu', $baseQuery->clone()->where('status', 'Menunggu')->count())
                    ->description('Jumlah pasien dalam antrian Anda')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('warning')
                    ->url(RekamMedisResource::getUrl('index', ['activeTab' => 'menunggu'])),
            ];
        }
        // JIKA YANG LOGIN ADALAH LOKET ATAU REKAM MEDIS
        else {
            $stats = [
                Stat::make('Total Pasien Terdaftar', Pasien::count())
                    ->description('Jumlah semua pasien di database')
                    ->descriptionIcon('heroicon-m-user-group')
                    ->color('success')
                    ->url(route('filament.admin.resources.pendaftarans.index')),

                Stat::make('Kunjungan Hari Ini', Pendaftaran::whereDate('created_at', today())->count())
                    ->description('Jumlah pasien yang mendaftar hari ini')
                    ->descriptionIcon('heroicon-m-arrow-trending-up')
                    ->color('info')
                    ->url(PendaftaranResource::getUrl('index', ['activeTab' => 'hari_ini'])),

                Stat::make('Pasien Menunggu', Pendaftaran::where('status', 'Menunggu')->count())
                    ->description('Jumlah pasien dalam antrian saat ini')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('warning')
                    ->url(PendaftaranResource::getUrl('index', ['activeTab' => 'menunggu'])),
            ];
        }

        return $stats;
    }
}
