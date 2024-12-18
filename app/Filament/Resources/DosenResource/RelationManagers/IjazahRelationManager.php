<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class IjazahRelationManager extends RelationManager
{
    protected static string $relationship = 'Ijazah';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat baru ijazah')
                    ->description('Please fill in the details to add a new ijazah.') // Deskripsi form
                    ->schema([
                        FileUpload::make('file')->directory('ijazah/ ' . $this->getOwnerRecord()->username)
                            ->acceptedFileTypes(['application/pdf'])
                            ->required(),
                        Grid::make(2)->schema([
                            Select::make('pendidikan')->options([
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ])->required(),
                            Select::make('type')->options([
                                'ijazah' => 'ijazah',
                                'transkrip' => 'transkrip',
                            ])->required()
                        ])
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('pendidikan')->searchable(),
                TextColumn::make('tipe')->searchable(),
                TextColumn::make('file')
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