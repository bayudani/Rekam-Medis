<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class KunjunganChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Kunjungan 7 Hari Terakhir';
    
    protected static ?int $sort = 2;

    // --- INI DIA FUNGSI YANG DIPERBAIKI ---
    public function getHeading(): string
    {
        $user = auth()->user();

        // Jika yang login dokter, ganti judulnya
        if ($user && $user->role === 'dokter') {
            return 'Grafik Kunjungan Anda (7 Hari Terakhir)';
        }

        // Jika bukan, pakai judul default
        return static::$heading;
    }

    protected function getData(): array
    {
        $user = auth()->user();
        $query = Pendaftaran::query();

        // JIKA YANG LOGIN ADALAH DOKTER, filter query-nya
        if ($user && $user->role === 'dokter') {
            $query->where('poli_id', $user->poli_id);
            // Baris yang menyebabkan error sudah dihapus dari sini
        }

        $data = $query
            ->where('created_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date');

        $labels = collect(range(6, 0))->map(function ($day) {
            return now()->subDays($day)->format('d M');
        });

        $chartData = $labels->map(function ($label) use ($data) {
            $date = Carbon::createFromFormat('d M', $label)->format('Y-m-d');
            return $data->get($date, 0);
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kunjungan',
                    'data' => $chartData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
