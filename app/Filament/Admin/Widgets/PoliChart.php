<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;

class PoliChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Kunjungan per Poli';

    protected static ?int $sort = 3; // Urutan widget di dashboard

    public static function canView(): bool
    {
        $user = auth()->user();
        // Cek dulu, user-nya ada ga?
        if (!$user) {
            return false;
        }
        return $user->role === 'rekam_medis';
    }
    protected function getData(): array
    {
        $data = Pendaftaran::query()
            ->join('polis', 'pendaftarans.poli_id', '=', 'polis.id')
            ->selectRaw('polis.nama_poli, COUNT(pendaftarans.id) as count')
            ->groupBy('polis.nama_poli')
            ->pluck('count', 'nama_poli');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pasien',
                    'data' => $data->values(),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                    ],
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
