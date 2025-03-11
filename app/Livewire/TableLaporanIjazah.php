<?php

namespace App\Livewire;

use App\Models\Ijazah;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanIjazah extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.ijazah.pdf'), true)
            ])
            ->query(
                Ijazah::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
                TextColumn::make('user.name')->label('Nama'),
                TextColumn::make('pendidikan'),
                TextColumn::make('tipe'),
            ]);
    }
}
