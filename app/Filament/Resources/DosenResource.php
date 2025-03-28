<?php

namespace App\Filament\Resources;


use App\Filament\Resources\DosenResource\Pages;
use App\Filament\Resources\DosenResource\RelationManagers\BkdRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\BukuRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\HkiRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\IjazahRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\JabatanFungsionalRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\KompetensiRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\OrganisasiRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\PangkatRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\PatenRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\PrestasiRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\SerdosRelationManager;
use App\Filament\Resources\DosenResource\RelationManagers\SkpRelationManager;
use App\Models\User;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class DosenResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Dosen';
    protected static ?string $modelLabel = 'Dosen';


    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canDelete(Model $model): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create New User') // Bagian utama
                    ->description('Please fill in the details to add a new user.') // Deskripsi form
                    ->schema([
                        Grid::make(2) // Layout 2 kolom
                            ->schema([
                                TextInput::make('nidn')->label('NIDN')->placeholder('Enter NIDN')->required()->maxLength(255),
                                TextInput::make('name')->label('Full Name')->placeholder('Enter full name')->required()->maxLength(255),
                                TextInput::make('email')->label('Email Address')->placeholder('example@mail.com')->email()->unique(ignoreRecord: true) // Validasi unik
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('username')->label('Username')->placeholder('Enter username')->unique(ignoreRecord: true)
                            ]),
                        Grid::make(1)
                            ->schema([
                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->placeholder('Enter password')
                                    ->required()
                                    ->confirmed() // Untuk konfirmasi password
                                    ->minLength(8)
                                    ->helperText('Password must be at least 8 characters.'),

                                TextInput::make('password_confirmation')
                                    ->label('Confirm Password')
                                    ->password()
                                    ->placeholder('Confirm your password')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::orderBy('created_at')->where('role', 'dosen'))
            ->columns([
                TextColumn::make('nidn')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
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
            IjazahRelationManager::class,
            BkdRelationManager::class,
            SkpRelationManager::class,
            PrestasiRelationManager::class,
            HkiRelationManager::class,
            PatenRelationManager::class,
            BukuRelationManager::class,
            KompetensiRelationManager::class,
            SerdosRelationManager::class,
            OrganisasiRelationManager::class,
            JabatanFungsionalRelationManager::class,
            PangkatRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'view' => Pages\ViewDosen::route('/{record}'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}
