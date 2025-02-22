<?php

namespace App\Filament\Tendik\Resources\DataTendikResource\Pages;

use App\Filament\Tendik\Resources\DataTendikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataTendik extends EditRecord
{
    protected static string $resource = DataTendikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
