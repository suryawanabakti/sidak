<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class SkpRelationManager extends RelationManager
{
    protected static string $relationship = 'Skp';

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat Baru SKP')
                    ->description('Please fill in the details to add a new SKP.') // Deskripsi form
                    ->schema([
                        FileUpload::make('file')->directory('skp/' . $this->getOwnerRecord()->username)
                            ->acceptedFileTypes(['application/pdf'])
                            ->required(),
                        DatePicker::make('tahun')
                            ->label('Tahun')
                            ->displayFormat('Y') // Menampilkan hanya tahun
                            ->format('Y')        // Format yang disimpan di database
                            ->required()
                            ->native(false)      // Menonaktifkan input bawaan browser
                            ->reactive()
                            ->closeOnDateSelection() // Menutup picker setelah memilih

                    ])

            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            // ->recordTitleAttribute('tahun')
            ->columns([
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->label('Download File')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->file)) // Membuat URL file
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
