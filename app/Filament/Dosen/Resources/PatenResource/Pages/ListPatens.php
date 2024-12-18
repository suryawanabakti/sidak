<?php

namespace App\Filament\Dosen\Resources\PatenResource\Pages;

use App\Filament\Dosen\Resources\PatenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatens extends ListRecords
{
    protected static string $resource = PatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
