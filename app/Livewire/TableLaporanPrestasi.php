<?php

namespace App\Livewire;

use App\Models\Prestasi;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanPrestasi extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.prestasi.pdf'), true)
            ])
            ->query(
                Prestasi::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('tanggal'),
                TextColumn::make('user.name'),
                TextColumn::make('judul'),
                TextColumn::make('tingkat'),
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
            ]);
    }
}
