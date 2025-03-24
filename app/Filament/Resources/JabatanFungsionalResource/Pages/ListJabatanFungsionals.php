<?php

namespace App\Filament\Dosen\Resources\JabatanFungsionalResource\Pages;

use App\Filament\Dosen\Resources\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJabatanFungsionals extends ListRecords
{
    protected static string $resource = JabatanFungsionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
