<?php

namespace App\Filament\Dosen\Resources\SerdosResource\Pages;

use App\Filament\Dosen\Resources\SerdosResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSerdos extends ViewRecord
{
    protected static string $resource = SerdosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
