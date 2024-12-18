<?php

namespace App\Filament\Dosen\Resources\SkpResource\Pages;

use App\Filament\Dosen\Resources\SkpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkps extends ListRecords
{
    protected static string $resource = SkpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
