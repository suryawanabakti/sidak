<?php

namespace App\Filament\Resources;

use App\Filament\Dosen\Resources\KompetensiResource\Pages;
use App\Filament\Dosen\Resources\KompetensiResource\RelationManagers;
use App\Models\Kompetensi;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KompetensiResource extends Resource
{
    protected static ?string $model = Kompetensi::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'Kompetensi';
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'staff';
    }
    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Grid::make(1)->schema([
                    FileUpload::make('sertifikat')->directory('kompetensi/' . auth()->user()->username)->required(),
                ]),
                TextInput::make('judul')->required(),
                TextInput::make('penyelenggara')->required(),
                Select::make('tingkat')->options([
                    'International' => 'International',
                    'Nasional' => 'Nasional',
                    'Lokal' => 'Lokal'
                ])->required(),
                DatePicker::make('tanggal')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Kompetensi::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('tanggal')->searchable()->sortable(),
                TextColumn::make('judul')->searchable()->sortable(),
                TextColumn::make('tingkat')->searchable()->sortable(),
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
            'index' => Pages\ListKompetensis::route('/'),
            'create' => Pages\CreateKompetensi::route('/create'),
            'view' => Pages\ViewKompetensi::route('/{record}'),
            'edit' => Pages\EditKompetensi::route('/{record}/edit'),
        ];
    }
}
