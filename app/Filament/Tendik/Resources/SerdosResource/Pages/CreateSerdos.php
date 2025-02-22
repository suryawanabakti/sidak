<?php

namespace App\Filament\Tendik\Resources\SerdosResource\Pages;

use App\Filament\Tendik\Resources\SerdosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSerdos extends CreateRecord
{
    protected static string $resource = SerdosResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
