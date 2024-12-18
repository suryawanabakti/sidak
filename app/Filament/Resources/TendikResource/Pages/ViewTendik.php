<?php

namespace App\Filament\Resources\TendikResource\Pages;

use App\Filament\Resources\TendikResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTendik extends ViewRecord
{
    protected static string $resource = TendikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
