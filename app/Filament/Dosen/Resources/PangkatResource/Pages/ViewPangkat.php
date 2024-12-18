<?php

namespace App\Filament\Dosen\Resources\PangkatResource\Pages;

use App\Filament\Dosen\Resources\PangkatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPangkat extends ViewRecord
{
    protected static string $resource = PangkatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
