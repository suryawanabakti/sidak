<?php

namespace App\Filament\Dosen\Resources\PatenResource\Pages;

use App\Filament\Dosen\Resources\PatenResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPaten extends ViewRecord
{
    protected static string $resource = PatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
