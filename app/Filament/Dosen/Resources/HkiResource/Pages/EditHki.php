<?php

namespace App\Filament\Dosen\Resources\HkiResource\Pages;

use App\Filament\Dosen\Resources\HkiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHki extends EditRecord
{
    protected static string $resource = HkiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
