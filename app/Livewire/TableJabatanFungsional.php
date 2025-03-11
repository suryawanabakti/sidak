<?php

namespace App\Livewire;

use App\Models\JabatanFungsional;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableJabatanFungsional extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.fungsional.pdf'), true)
            ])
            ->query(
                JabatanFungsional::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('tmt'),
                TextColumn::make('updated_at')->label('Tanggal Verifikasi'),
            ]);
    }
}
