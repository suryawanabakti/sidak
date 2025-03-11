<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use App\Models\Hki;
use App\Models\Ijazah;
use App\Models\JabatanFungsional;
use App\Models\Organisasi;
use App\Models\Pangkat;
use App\Models\Paten;
use App\Models\Prestasi;
use App\Models\Serdos;
use App\Models\Skp;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VerificationProccessOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Buku', Buku::where('status', 'proses')->count())->description(
                'Belum di verifikasi'
            ),
            Stat::make('Jumlah Hki', Hki::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Ijazah', Ijazah::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah JabatanFungsional', JabatanFungsional::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Organisasi', Organisasi::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Pangkat', Pangkat::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Paten', Paten::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Prestasi', Prestasi::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Serdos', Serdos::where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Skp', Skp::where('status', 'proses')->count())->description('Belum di verifikasi'),
        ];
    }
}
