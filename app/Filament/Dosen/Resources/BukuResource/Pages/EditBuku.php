<?php

namespace App\Filament\Dosen\Resources\BukuResource\Pages;

use App\Filament\Dosen\Resources\BukuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBuku extends EditRecord
{
    protected static string $resource = BukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
