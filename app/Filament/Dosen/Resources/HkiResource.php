<?php

namespace App\Filament\Dosen\Resources;

use App\Filament\Dosen\Resources\HkiResource\Pages;
use App\Filament\Dosen\Resources\HkiResource\RelationManagers;
use App\Models\Hki;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class HkiResource extends Resource
{
    protected static ?string $model = Hki::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'HKI';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat hki baru')->description('Please fill')
                    ->schema([
                        FileUpload::make('sertifikat')->directory('hki/' . auth()->user()->username)
                            ->acceptedFileTypes(['application/pdf']),
                        Grid::make(2)->schema([
                            DatePicker::make('tanggal'),
                            TextInput::make('judul'),
                        ]),
                        Grid::make(1)->schema([
                            Select::make('tingkat')->options([
                                'International' => 'International',
                                'Nasional' => 'Nasional',
                                'Lokal' => 'Lokal',
                            ]),

                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            'index' => Pages\ListHkis::route('/'),
            'create' => Pages\CreateHki::route('/create'),
            'view' => Pages\ViewHki::route('/{record}'),
            'edit' => Pages\EditHki::route('/{record}/edit'),
        ];
    }
}
