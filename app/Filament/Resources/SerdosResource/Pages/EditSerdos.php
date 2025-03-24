<?php

namespace App\Filament\Dosen\Resources\SerdosResource\Pages;

use App\Filament\Dosen\Resources\SerdosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSerdos extends EditRecord
{
    protected static string $resource = SerdosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
