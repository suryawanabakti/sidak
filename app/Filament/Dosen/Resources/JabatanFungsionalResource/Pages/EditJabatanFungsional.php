<?php

namespace App\Filament\Dosen\Resources\JabatanFungsionalResource\Pages;

use App\Filament\Dosen\Resources\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJabatanFungsional extends EditRecord
{
    protected static string $resource = JabatanFungsionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
