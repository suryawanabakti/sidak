<?php

namespace App\Filament\Dosen\Resources\PatenResource\Pages;

use App\Filament\Dosen\Resources\PatenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaten extends EditRecord
{
    protected static string $resource = PatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
