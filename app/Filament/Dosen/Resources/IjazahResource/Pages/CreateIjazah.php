<?php

namespace App\Filament\Dosen\Resources\IjazahResource\Pages;

use App\Filament\Dosen\Resources\IjazahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIjazah extends CreateRecord
{
    protected static string $resource = IjazahResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }
        return $data;
    }
}
