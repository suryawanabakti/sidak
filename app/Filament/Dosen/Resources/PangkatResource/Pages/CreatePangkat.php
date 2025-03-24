<?php

namespace App\Filament\Dosen\Resources\PangkatResource\Pages;

use App\Filament\Dosen\Resources\PangkatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePangkat extends CreateRecord
{
    protected static string $resource = PangkatResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }
        return $data;
    }
}
