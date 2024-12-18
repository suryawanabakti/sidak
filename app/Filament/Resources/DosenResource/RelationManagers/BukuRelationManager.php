<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuRelationManager extends RelationManager
{
    protected static string $relationship = 'buku';
    public static function getCreateFormModalHeading(): string
    {
        return 'Tambah Data Buku Baru'; // Ganti teks sesuai keinginan
    }
    public  function form(Form $form): Form
    {
        return $form

            ->schema([
                TextInput::make('judul')->required(),
                TextInput::make('penerbit')->required(),
                TextInput::make('tahun')->numeric()->minLength(4)->maxLength(4)->required(),
                Textarea::make('anggota')->required(),
                TextInput::make('link')->required(),
            ]);
    }

    public  function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable(),
                TextColumn::make('tahun')->searchable(),
                TextColumn::make('link')->searchable()->sortable()
                    ->label('Open Link')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => $record->link) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary')
            ])
            ->filters([
                //
            ])->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
