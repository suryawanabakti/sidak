<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class HkiRelationManager extends RelationManager
{
    protected static string $relationship = 'hki';

    public  function form(Form $form): Form
    {

        return $form

            ->schema([
                Section::make('Form HKI')->description('HKI (Hak Kekayaan Intelektual) adalah hak eksklusif yang diberikan kepada individu atau kelompok atas karya ciptaannya yang muncul dari hasil olah pikir atau intelektual manusia. HKI memberikan perlindungan hukum kepada pemilik karya atas penggunaan, pemanfaatan, dan distribusi karya tersebut oleh pihak lain tanpa izin.')
                    ->schema([
                        FileUpload::make('sertifikat')->directory('hki/' . $this->getOwnerRecord()->username)
                            ->acceptedFileTypes(['application/pdf'])->required(),
                        Grid::make(2)->schema([
                            DatePicker::make('tanggal')->required(),
                            TextInput::make('judul')->required(),
                        ]),
                        Textarea::make('anggota')->required()
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->recordTitleAttribute('judul')
            ->columns([
                Tables\Columns\TextColumn::make('judul'),
                TextColumn::make('sertifikat')->searchable()->sortable()
                    ->label('Download File')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->sertifikat)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('New HKI')->label('New HKI'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
