<?php

namespace App\Filament\Tendik\Resources\DataTendikResource\Pages;

use App\Filament\Tendik\Resources\DataTendikResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDataTendik extends CreateRecord
{
    protected static string $resource = DataTendikResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
