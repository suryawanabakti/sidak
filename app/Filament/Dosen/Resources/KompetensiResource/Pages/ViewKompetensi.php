<?php

namespace App\Filament\Dosen\Resources\KompetensiResource\Pages;

use App\Filament\Dosen\Resources\KompetensiResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewKompetensi extends ViewRecord
{
    protected static string $resource = KompetensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('downloadKompetensi')
                ->label('Download Kompetensi')
                // ->icon('heroicon-o-download') // Optional icon
                ->action(function () {
                    $record = $this->getRecord();

                    // Assuming 'file_path' is the attribute storing the file path
                    $filePath = $record->sertifikat;

                    // Validate file existence
                    if (Storage::disk('public')->exists($filePath)) {
                        return response()->download(Storage::disk('public')->path($filePath));
                    }

                    // Handle file not found
                    notification()->danger('File not found.');
                }),
        ];
    }
}
