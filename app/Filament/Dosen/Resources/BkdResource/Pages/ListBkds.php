<?php

namespace App\Filament\Dosen\Resources\BkdResource\Pages;

use App\Filament\Dosen\Resources\BkdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBkds extends ListRecords
{
    protected static string $resource = BkdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
