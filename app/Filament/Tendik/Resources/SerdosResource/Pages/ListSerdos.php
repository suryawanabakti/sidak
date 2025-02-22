<?php

namespace App\Filament\Tendik\Resources\SerdosResource\Pages;

use App\Filament\Tendik\Resources\SerdosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSerdos extends ListRecords
{
    protected static string $resource = SerdosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
