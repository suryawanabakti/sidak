<?php

namespace App\Filament\Dosen\Resources\OrganisasiResource\Pages;

use App\Filament\Dosen\Resources\OrganisasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganisasi extends CreateRecord
{
    protected static string $resource = OrganisasiResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
