<?php

namespace App\Filament\Tendik\Resources;

use App\Filament\Tendik\Resources\SerdosResource\Pages;
use App\Filament\Tendik\Resources\SerdosResource\RelationManagers;
use App\Models\Serdos;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class SerdosResource extends Resource
{
    protected static ?string $model = Serdos::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Tendik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    FileUpload::make('sertifikat')->required()->directory('serdos/' . auth()->user()->username),
                ]),
                DatePicker::make('tmt')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Serdos::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('tmt')->searchable(),
                TextColumn::make('sertifikat')
                    ->label('Download')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->sertifikat)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary')
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
            'index' => Pages\ListSerdos::route('/'),
            'create' => Pages\CreateSerdos::route('/create'),
            'edit' => Pages\EditSerdos::route('/{record}/edit'),
        ];
    }
}
