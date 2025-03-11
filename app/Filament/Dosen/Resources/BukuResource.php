<?php

namespace App\Filament\Dosen\Resources;

use App\Filament\Dosen\Resources\BukuResource\Pages;
use App\Filament\Dosen\Resources\BukuResource\RelationManagers;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'Buku';
    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->query(Buku::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('judul')->searchable(),
                TextColumn::make('tahun')->searchable(),
                TextColumn::make('link')->searchable()->sortable()
                    ->label('Open Link')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => $record->link) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary'),
                TextColumn::make('status'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBukus::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'view' => Pages\ViewBuku::route('/{record}'),
            'edit' => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}
