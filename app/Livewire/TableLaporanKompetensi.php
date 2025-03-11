<?php

namespace App\Livewire;

use App\Models\Kompetensi;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanKompetensi extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.kompetensi.pdf'), true)
            ])
            ->query(
                Kompetensi::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('tanggal'),
                TextColumn::make('user.name'),
                TextColumn::make('judul'),
                TextColumn::make('penyelenggara'),
                TextColumn::make('tingkat'),
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
            ]);
    }
}
