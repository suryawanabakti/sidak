<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;


use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BkdRelationManager extends RelationManager
{
    protected static string $relationship = 'Bkd';

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buat Baru BKD')
                    ->description('Please fill in the details to add a new BKD.') // Deskripsi form
                    ->schema([
                        FileUpload::make('file')->directory('bkd/' . $this->getOwnerRecord()->username)
                            ->acceptedFileTypes(['application/pdf'])
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('semester')
            ->columns([
                Tables\Columns\TextColumn::make('semester')->searchable()->sortable(),
                TextColumn::make('file')
                    ->label('Download File')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->file)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary'),
                Tables\Columns\TextColumn::make('status')->searchable()->sortable()->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->modalHeading('Konfirmasi Persetujuan')
                        ->modalDescription('Apakah Anda yakin ingin menyetujui ini?')
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
                        ->modalDescription('Apakah Anda yakin ingin menyetujui  ini?')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
