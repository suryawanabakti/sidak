<?php

namespace App\Filament\Dosen\Resources\KompetensiResource\Pages;

use App\Filament\Dosen\Resources\KompetensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKompetensis extends ListRecords
{
    protected static string $resource = KompetensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
