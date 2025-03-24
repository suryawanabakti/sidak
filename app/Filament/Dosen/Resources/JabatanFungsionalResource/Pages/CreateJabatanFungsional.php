<?php

namespace App\Filament\Dosen\Resources\JabatanFungsionalResource\Pages;

use App\Filament\Dosen\Resources\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJabatanFungsional extends CreateRecord
{
    protected static string $resource = JabatanFungsionalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }
        return $data;
    }
}
