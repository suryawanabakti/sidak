<?php

namespace App\Filament\Dosen\Resources\KompetensiResource\Pages;

use App\Filament\Dosen\Resources\KompetensiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKompetensi extends CreateRecord
{
    protected static string $resource = KompetensiResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
