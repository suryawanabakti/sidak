<?php

namespace App\Livewire;

use App\Exports\KompetensiExport;
use App\Models\Kompetensi;

use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;

class LaporanKompetensi extends BaseWidget
{

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_excel')
                    ->label('Export Excel')
                    // ->icon('heroicon-o-download')
                    ->color('success')
                    ->action(fn() => Excel::download(new KompetensiExport, 'laporan_kompetensi.xlsx'))
            ])
            ->query(
                Kompetensi::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('user.name')->searchable()->sortable()->label('Nama'),
                TextColumn::make('tanggal')->searchable()->sortable(),
                TextColumn::make('judul')->searchable()->sortable(),
                TextColumn::make('tingkat')->searchable()->sortable()
            ]);
    }
}
