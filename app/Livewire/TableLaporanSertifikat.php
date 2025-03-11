<?php

namespace App\Livewire;

use App\Models\Serdos;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableLaporanSertifikat extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.sertifikat.pdf'), true)
            ])
            ->query(
                Serdos::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('tmt'),
                TextColumn::make('user.name'),
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
            ]);
    }
}
