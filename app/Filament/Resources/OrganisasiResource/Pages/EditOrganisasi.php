<?php

namespace App\Filament\Dosen\Resources\OrganisasiResource\Pages;

use App\Filament\Dosen\Resources\OrganisasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganisasi extends EditRecord
{
    protected static string $resource = OrganisasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
