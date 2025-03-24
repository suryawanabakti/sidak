<?php

namespace App\Filament\Dosen\Resources\IjazahResource\Pages;

use App\Filament\Dosen\Resources\IjazahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIjazahs extends ListRecords
{
    protected static string $resource = IjazahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
