<?php

namespace App\Filament\Dosen\Resources\KompetensiResource\Pages;

use App\Filament\Dosen\Resources\KompetensiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKompetensi extends EditRecord
{
    protected static string $resource = KompetensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
