<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganisasiRelationManager extends RelationManager
{
    protected static string $relationship = 'organisasi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_organisasi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_organisasi')
            ->columns([
                Tables\Columns\TextColumn::make('nama_organisasi'),
                Tables\Columns\TextColumn::make('status')->searchable()->sortable()->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->modalHeading('Konfirmasi Persetujuan')
                        ->modalDescription('Apakah Anda yakin ingin menyetujui pembayaran ini?')
                        ->modalSubmitActionLabel('Terima')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($record) {
                            $record->update(['status' => "diterima"]);
                            Notification::make()
                                ->title('Status diterima berhasil')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\Action::make('tolak')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->modalHeading('Konfirmasi Persetujuan')
                        ->modalDescription('Apakah Anda yakin ingin menyetujui pembayaran ini?')
                        ->modalSubmitActionLabel('Tolak')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($record) {
                            $record->update(['status' => "ditolak"]);
                            Notification::make()
                                ->title('Status ditolak berhasil')
                                ->success()
                                ->send();
                        })
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
