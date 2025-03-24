<?php

namespace App\Filament\Dosen\Resources\BkdResource\Pages;

use App\Filament\Dosen\Resources\BkdResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewBkd extends ViewRecord
{
    protected static string $resource = BkdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('downloadBkd')
                ->label('Download File BKD')
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
