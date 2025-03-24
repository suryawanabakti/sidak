<?php

namespace App\Filament\Dosen\Resources\IjazahResource\Pages;

use App\Filament\Dosen\Resources\IjazahResource;
use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewIjazah extends ViewRecord
{
    protected static string $resource = IjazahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('downloadIjazah')
                ->label('Download Ijazah')
                // ->icon('heroicon-o-download') // Optional icon
                ->action(function () {
                    $record = $this->getRecord();

                    // Assuming 'file_path' is the attribute storing the file path
                    $filePath = $record->file;

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
