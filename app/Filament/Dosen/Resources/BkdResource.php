<?php

namespace App\Filament\Dosen\Resources;

use App\Filament\Dosen\Resources\BkdResource\Pages;
use App\Filament\Dosen\Resources\BkdResource\RelationManagers;
use App\Models\Bkd;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BkdResource extends Resource
{
    protected static ?string $model = Bkd::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'BKD';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat Baru BKD')
                    ->description('Please fill in the details to add a new BKD.') // Deskripsi form
                    ->schema([
                        FileUpload::make('file')->directory('bkd/' . auth()->user()->username)
                            ->required(),

                        Select::make('semester')->options([
                            1 => 'Semester 1',
                            2 => 'Semester 2',
                            3 => 'Semester 3',
                            4 => 'Semester 4',
                            5 => 'Semester 5',
                            6 => 'Semester 6',
                            7 => 'Semester 7',
                            8 => 'Semester 8',
                            9 => 'Semester 9',
                            10 => 'Semester 10',
                            11 => 'Semester 11',
                            12 => 'Semester 12',
                            13 => 'Semester 13',
                            14 => 'Semester 14',
                        ])->required(),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Bkd::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('semester'),
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
            'index' => Pages\ListBkds::route('/'),
            'create' => Pages\CreateBkd::route('/create'),
            'view' => Pages\ViewBkd::route('/{record}'),
            'edit' => Pages\EditBkd::route('/{record}/edit'),
        ];
    }
}
