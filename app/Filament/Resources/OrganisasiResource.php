<?php

namespace App\Filament\Resources;

use App\Filament\Dosen\Resources\OrganisasiResource\Pages;
use App\Filament\Dosen\Resources\OrganisasiResource\RelationManagers;
use App\Models\Organisasi;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class OrganisasiResource extends Resource
{
    protected static ?string $model = Organisasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Menu Dosen';
    protected static ?string $pluralModelLabel = 'Organisasi';
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'staff';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('kartu_anggota')->directory('kartuanggota/' . auth()->user()->username)->required(),
                FileUpload::make('sertifikat')->directory('sertifikatorganisasi/' . auth()->user()->username)->required(),
                TextInput::make('nama_organisasi')->required(),
                DatePicker::make('tanggal_aktif')->required(),
                DatePicker::make('tanggal_berakhir')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Organisasi::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('nama_organisasi'),
                TextColumn::make('tanggal_aktif'),
                TextColumn::make('tanggal_berakhir'),
                TextColumn::make('kartu_anggota')
                    ->label('Kartu Anggota')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->kartu_anggota)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary'),
                TextColumn::make('sertifikat')
                    ->label('Sertifikat')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->sertifikat)) // Membuat URL file
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
            'index' => Pages\ListOrganisasis::route('/'),
            'create' => Pages\CreateOrganisasi::route('/create'),
            'view' => Pages\ViewOrganisasi::route('/{record}'),
            'edit' => Pages\EditOrganisasi::route('/{record}/edit'),
        ];
    }
}
