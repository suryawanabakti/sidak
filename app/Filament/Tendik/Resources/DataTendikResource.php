<?php

namespace App\Filament\Tendik\Resources;

use App\Filament\Tendik\Resources\DataTendikResource\Pages;
use App\Filament\Tendik\Resources\DataTendikResource\RelationManagers;
use App\Models\DataTendik;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class DataTendikResource extends Resource
{
    protected static ?string $model = DataTendik::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Data Tendik';
    protected static ?string $modelLabel = 'Data Tendik';
    protected static ?string $pluralModelLabel = 'Data Tendik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('ktp')->required(),
                FileUpload::make('kk')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = DataTendik::query();
        if (!auth()->user()->role === 'admin') {
            $query->where('user_id', auth()->id());
        }
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('ktp')
                    ->label('KTP')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->ktp)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary'),
                TextColumn::make('kk')
                    ->label('KK')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->kk)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDataTendiks::route('/'),
            'create' => Pages\CreateDataTendik::route('/create'),
            'edit' => Pages\EditDataTendik::route('/{record}/edit'),
        ];
    }
}
