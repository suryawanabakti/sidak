<?php

namespace App\Livewire;

use App\Exports\KompetensiExport;
use App\Models\Kompetensi;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

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
            ->filters([
                SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name') // Correct way to use relationships in Filament
                    ->options(User::pluck('name', 'id')),
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
