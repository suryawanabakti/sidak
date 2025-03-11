<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LaporanPrestasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Laporan';

    protected static string $view = 'filament.pages.laporan-prestasi';
}
