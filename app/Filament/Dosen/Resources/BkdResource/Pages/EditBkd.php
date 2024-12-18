<?php

namespace App\Filament\Dosen\Resources\BkdResource\Pages;

use App\Filament\Dosen\Resources\BkdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBkd extends EditRecord
{
    protected static string $resource = BkdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
