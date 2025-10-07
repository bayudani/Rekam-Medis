<?php

namespace App\Filament\Admin\Resources\PasienResource\Pages;

use App\Filament\Admin\Resources\PasienResource;
use App\Filament\Admin\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;

    protected function getRedirectUrl(): string
    {
        $pasien = $this->getRecord(); // Ambil data pasien yang baru saja dibuat

        // Generate URL ke halaman 'create' PendaftaranResource
        // sambil membawa ID pasien baru sebagai parameter
        return PendaftaranResource::getUrl('create', ['pasien_id' => $pasien->id]);
    }
}
