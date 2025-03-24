<?php

namespace App\Filament\Dosen\Resources\HkiResource\Pages;

use App\Filament\Dosen\Resources\HkiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHki extends CreateRecord
{
    protected static string $resource = HkiResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }
        return $data;
    }
}
