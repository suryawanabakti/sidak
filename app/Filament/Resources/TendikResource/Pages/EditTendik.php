<?php

namespace App\Filament\Resources\TendikResource\Pages;

use App\Filament\Resources\TendikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTendik extends EditRecord
{
    protected static string $resource = TendikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
