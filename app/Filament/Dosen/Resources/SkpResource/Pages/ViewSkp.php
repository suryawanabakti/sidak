<?php

namespace App\Filament\Dosen\Resources\SkpResource\Pages;


use App\Filament\Dosen\Resources\SkpResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;

class ViewSkp extends ViewRecord
{
    protected static string $resource = SkpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('downloadSkp')
                ->label('Download File SKP')
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
