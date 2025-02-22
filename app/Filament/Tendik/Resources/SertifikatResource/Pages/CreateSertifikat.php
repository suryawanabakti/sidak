<?php

namespace App\Filament\Tendik\Resources\SertifikatResource\Pages;

use App\Filament\Tendik\Resources\SertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSertifikat extends CreateRecord
{
    protected static string $resource = SertifikatResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
