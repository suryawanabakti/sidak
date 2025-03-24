<?php

namespace App\Filament\Dosen\Resources\SkpResource\Pages;

use App\Filament\Dosen\Resources\SkpResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSkp extends CreateRecord
{
    protected static string $resource = SkpResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }
        return $data;
    }
}
