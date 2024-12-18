<?php

namespace App\Filament\Dosen\Resources\PangkatResource\Pages;

use App\Filament\Dosen\Resources\PangkatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPangkats extends ListRecords
{
    protected static string $resource = PangkatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
