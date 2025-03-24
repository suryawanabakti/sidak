<?php

namespace App\Filament\Dosen\Resources\BkdResource\Pages;

use App\Filament\Dosen\Resources\BkdResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBkd extends CreateRecord
{
    protected static string $resource = BkdResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        if (auth()->user()->role === "staff") {
            $data['status'] = "diterima";
        }

        return $data;
    }
}
