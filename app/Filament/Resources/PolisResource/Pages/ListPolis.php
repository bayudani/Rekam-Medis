<?php

namespace App\Filament\Resources\PolisResource\Pages;

use App\Filament\Resources\PolisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPolis extends ListRecords
{
    protected static string $resource = PolisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
