<?php

namespace App\Filament\Resources;

use App\Filament\Dosen\Resources\IjazahResource\Pages;
use App\Filament\Dosen\Resources\IjazahResource\RelationManagers;
use App\Models\Ijazah;
use Filament\Forms;
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
use Random\Engine\Secure;

class IjazahResource extends Resource
{
    protected static ?string $model = Ijazah::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'Ijazah';
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'staff';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat baru ijazah')
                    ->description('Please fill in the details to add a new ijazah.') // Deskripsi form
                    ->schema([
                        FileUpload::make('file')->directory('ijazah/' . auth()->user()->username)

                            ->required(),
                        Grid::make(2)->schema([
                            Select::make('pendidikan')->options([
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ])->required(),
                            Select::make('tipe')->options([
                                'ijazah' => 'ijazah',
                                'transkrip' => 'transkrip',
                            ])->required()
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Ijazah::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('pendidikan'),
                TextColumn::make('tipe'),
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
            'index' => Pages\ListIjazahs::route('/'),
            'create' => Pages\CreateIjazah::route('/create'),
            'edit' => Pages\EditIjazah::route('/{record}/edit'),
            'view' => Pages\ViewIjazah::route('/{record}'),
        ];
    }
}
