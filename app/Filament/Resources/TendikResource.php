<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TendikResource\Pages;
use App\Filament\Resources\TendikResource\RelationManagers;
use App\Models\User;
use App\Models\User\Tendik;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TendikResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Tendik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat baru tendik') // Bagian utama
                    ->description('Please fill in the details to add a new tendik.') // Deskripsi form
                    ->schema([
                        Grid::make(2) // Layout 2 kolom
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->placeholder('Enter full name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->placeholder('example@mail.com')
                                    ->email()
                                    ->unique('users', 'email') // Validasi unik
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('username')
                                    ->label('Username')
                                    ->placeholder('Enter username')
                                    ->unique('users', 'username') // Validasi unik
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(50)
                                    ->helperText('Username must be unique and 3-50 characters long.'),
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
            ->query(User::orderBy('created_at')->where('role', 'tendik'))
            ->columns([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTendiks::route('/'),
            'create' => Pages\CreateTendik::route('/create'),
            'view' => Pages\ViewTendik::route('/{record}'),
            'edit' => Pages\EditTendik::route('/{record}/edit'),
        ];
    }
}
