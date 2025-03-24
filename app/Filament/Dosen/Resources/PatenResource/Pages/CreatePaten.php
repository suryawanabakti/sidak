<?php

namespace App\Filament\Dosen\Resources\PatenResource\Pages;

use App\Filament\Dosen\Resources\PatenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaten extends CreateRecord
{
    protected static string $resource = PatenResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }
        return $data;
    }
}
