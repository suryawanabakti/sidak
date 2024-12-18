<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PrestasiRelationManager extends RelationManager
{
    protected static string $relationship = 'prestasi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat prestasi baru')->description('Please fill')
                    ->schema([

                        FileUpload::make('sertifikat')->directory($this->getOwnerRecord()->username . '/prestasi')->acceptedFileTypes(['application/pdf'])->required(),
                        Grid::make(2)->schema([
                            DatePicker::make('tanggal')->required(),
                            TextInput::make('judul')->required(),
                        ]),
                        Grid::make(1)->schema([
                            Select::make('tingkat')->options([
                                'International' => 'International',
                                'Nasional' => 'Nasional',
                                'Lokal' => 'Lokal',
                            ])->required(),

                        ])
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                TextColumn::make('tanggal'),
                TextColumn::make('judul'),
                TextColumn::make('tingkat'),
                TextColumn::make('sertifikat')
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
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}