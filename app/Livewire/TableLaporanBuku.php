<?php

namespace App\Livewire;

use App\Exports\BukuExport;
use App\Models\Buku;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Maatwebsite\Excel\Facades\Excel;

class TableLaporanBuku extends BaseWidget
{

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->color('success')
                    ->url(fn() => route('export.buku.pdf'), true),
                Action::make('export_excel')
                    ->label('Export Excel')
                    // ->icon('heroicon-o-download')
                    ->color('success')
                    ->action(fn() => Excel::download(new BukuExport, 'buku.xlsx'))
            ])
            ->query(
                Buku::where('status', 'diterima')
            )
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

            ->columns([
                TextColumn::make('updated_at')->label('Tanggal Verifikasi')->searchable(),
                TextColumn::make('user.name')->searchable()->label('Nama')->searchable(),
                TextColumn::make('judul')->searchable(),
                TextColumn::make('penerbit')->searchable(),
                TextColumn::make('tahun')->searchable(),
                TextColumn::make('anggota')->searchable(),
            ]);
    }
}
