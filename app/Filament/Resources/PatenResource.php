<?php

namespace App\Filament\Resources;

use App\Filament\Dosen\Resources\PatenResource\Pages;
use App\Filament\Dosen\Resources\PatenResource\RelationManagers;
use App\Models\Paten;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PatenResource extends Resource
{
    protected static ?string $model = Paten::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'Paten';
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'staff';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Paten')->description('Paten adalah hak eksklusif yang diberikan oleh negara kepada penemu atas hasil invensi (penemuannya) di bidang teknologi untuk jangka waktu tertentu.')
                    ->schema([
                        FileUpload::make('sertifikat')->directory('paten/' . auth()->user()->username)
                            ->acceptedFileTypes(['application/pdf'])->required(),
                        Grid::make(2)->schema([
                            DatePicker::make('tanggal')->required(),
                            TextInput::make('judul')->required(),
                        ]),
                        Textarea::make('anggota')->required(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Paten::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('tanggal')->searchable()->sortable(),
                TextColumn::make('judul')->searchable()->sortable(),
                TextColumn::make('sertifikat')->searchable()->sortable()
                    ->label('Download File')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->sertifikat)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary'),
                // TextColumn::make('updated_at')->searchable()->sortable()->label('Tanggal Verifikasi'),
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
            'index' => Pages\ListPatens::route('/'),
            'create' => Pages\CreatePaten::route('/create'),
            'view' => Pages\ViewPaten::route('/{record}'),
            'edit' => Pages\EditPaten::route('/{record}/edit'),
        ];
    }
}
