<?php

namespace App\Filament\Dosen\Resources;

use App\Filament\Dosen\Resources\PangkatResource\Pages;
use App\Filament\Dosen\Resources\PangkatResource\RelationManagers;
use App\Models\Pangkat;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PangkatResource extends Resource
{
    protected static ?string $model = Pangkat::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'Pangkat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('file')->required()->directory('jabatanfungsional/' . auth()->user()->username),
                DatePicker::make('tmt')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Pangkat::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('tmt'),
                TextColumn::make('file')
                    ->label('Download File')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->file)) // Membuat URL file
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
            'index' => Pages\ListPangkats::route('/'),
            'create' => Pages\CreatePangkat::route('/create'),
            'view' => Pages\ViewPangkat::route('/{record}'),
            'edit' => Pages\EditPangkat::route('/{record}/edit'),
        ];
    }
}
