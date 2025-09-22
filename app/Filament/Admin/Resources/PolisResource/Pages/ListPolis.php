<?php

namespace App\Filament\Admin\Resources\PolisResource\Pages;

use App\Filament\Admin\Resources\PolisResource;
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
