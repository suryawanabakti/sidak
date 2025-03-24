<?php

namespace App\Filament\Dosen\Resources\HkiResource\Pages;

use App\Filament\Dosen\Resources\HkiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHki extends ViewRecord
{
    protected static string $resource = HkiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
