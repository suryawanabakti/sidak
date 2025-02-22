<?php

namespace App\Filament\Tendik\Resources\IjazahResource\Pages;

use App\Filament\Tendik\Resources\IjazahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIjazah extends CreateRecord
{
    protected static string $resource = IjazahResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
