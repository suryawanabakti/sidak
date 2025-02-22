<?php

namespace App\Filament\Tendik\Resources\SerdosResource\Pages;

use App\Filament\Tendik\Resources\SerdosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSerdos extends EditRecord
{
    protected static string $resource = SerdosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
