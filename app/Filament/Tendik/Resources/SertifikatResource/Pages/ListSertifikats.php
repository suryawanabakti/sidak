<?php

namespace App\Filament\Tendik\Resources\SertifikatResource\Pages;

use App\Filament\Tendik\Resources\SertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSertifikats extends ListRecords
{
    protected static string $resource = SertifikatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
