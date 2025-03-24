<?php

namespace App\Filament\Resources;

use App\Filament\Dosen\Resources\SkpResource\Pages;
use App\Filament\Dosen\Resources\SkpResource\RelationManagers;
use App\Models\Skp;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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

class SkpResource extends Resource
{
    protected static ?string $model = Skp::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'SKP';
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'staff';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat Baru SKP')
                    ->description('Please fill in the details to add a new SKP.') // Deskripsi form
                    ->schema([
                        FileUpload::make('file')->directory('skp/' . auth()->user()->username)

                            ->required(),
                        TextInput::make('tahun')->numeric()->minLength(4)->required(),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Skp::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('tahun'),
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
            'index' => Pages\ListSkps::route('/'),
            'create' => Pages\CreateSkp::route('/create'),
            'edit' => Pages\EditSkp::route('/{record}/edit'),
            'view' => Pages\ViewSkp::route('/{record}'),
        ];
    }
}
