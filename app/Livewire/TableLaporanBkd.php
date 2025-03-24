<?php

namespace App\Livewire;

use App\Exports\BkdExport;
use App\Models\Bkd;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name') // Correct way to use relationships in Filament
                    ->options(\App\Models\User::pluck('name', 'id')),
                Filter::make('updated_at')
                    ->form([
                        DatePicker::make('from')->label('From Date'),
                        DatePicker::make('to')->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->where('updated_at', '>=', Carbon::parse($data['from'])))
                            ->when($data['to'], fn($q) => $q->where('updated_at', '<=', Carbon::parse($data['to'])->endOfDay()));
                    }),
            ])
            ->query(
                Bkd::where('status', 'diterima')
            )
            ->columns([
                TextColumn::make('created_at'),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('semester')->searchable(),
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
