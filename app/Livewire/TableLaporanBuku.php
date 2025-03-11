<?php

namespace App\Livewire;

use App\Models\Buku;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanBuku extends BaseWidget
{

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.buku.pdf'), true)
            ])
            ->query(
                Buku::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
                TextColumn::make('user.name')->label('Nama'),
                TextColumn::make('judul'),
                TextColumn::make('penerbit'),
                TextColumn::make('tahun'),
                TextColumn::make('anggota'),
            ]);
    }
}
