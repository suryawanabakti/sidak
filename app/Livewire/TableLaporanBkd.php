<?php

namespace App\Livewire;

use App\Exports\BkdExport;
use App\Models\Bkd;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TableLaporanBkd extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_excel')
                    ->label('Export Excel')
                    // ->icon('heroicon-o-download')
                    ->color('success')
                    ->action(fn() => Excel::download(new BkdExport, 'laporan_bkd.xlsx'))
            ])
            ->query(
                Bkd::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('created_at'),
                TextColumn::make('user.name'),
                TextColumn::make('semester'),
                TextColumn::make('file')
                    ->label('File')
                    ->formatStateUsing(fn($state) => basename($state)) // Menampilkan hanya nama file
                    ->url(fn($record) => Storage::url($record->file)) // Membuat URL file
                    ->openUrlInNewTab() // Buka file di tab baru
                    ->icon('heroicon-o-arrow-down-on-square') // Tambahkan ikon download
                    ->color('primary')
            ]);
    }
}
