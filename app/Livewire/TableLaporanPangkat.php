<?php

namespace App\Livewire;

use App\Models\Pangkat;
use Filament\Tables\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanPangkat extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.pangkat.pdf'), true)
            ])
            ->query(
                Pangkat::where('status', 'diterima')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nama'),
                Tables\Columns\TextColumn::make('tmt')->label('TMT'),
                Tables\Columns\TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
            ]);
    }
}
