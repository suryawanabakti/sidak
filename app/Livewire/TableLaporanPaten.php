<?php

namespace App\Livewire;

use App\Models\Paten;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanPaten extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.paten.pdf'), true)
            ])
            ->query(
                Paten::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('tanggal')->label('Tanggal'),
                TextColumn::make('user.name')->label('Nama'),
                TextColumn::make('judul')->label('Judul'),
                TextColumn::make('anggota')->label('Anggota'),
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
            ]);
    }
}
