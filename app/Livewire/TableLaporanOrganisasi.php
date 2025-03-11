<?php

namespace App\Livewire;

use App\Models\Organisasi;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanOrganisasi extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.organisasi.pdf'), true)
            ])
            ->query(
                Organisasi::where('status', 'diterima')
                    ->with('user')
            )
            ->columns([
                TextColumn::make('user.name')->label('Nama'),
                TextColumn::make('nama_organisasi'),
                // TextColumn::make('kartu_anggota'),
                TextColumn::make('tanggal_aktif'),
                TextColumn::make('tanggal_berakhir'),
                TextColumn::make('updated_at')->label('Tanggal Diverifikasi'),
            ]);
    }
}
