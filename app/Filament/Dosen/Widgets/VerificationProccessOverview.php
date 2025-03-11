<?php

namespace App\Filament\Dosen\Widgets;

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
            Stat::make('Jumlah Buku', Buku::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Hki', Hki::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Ijazah', Ijazah::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah JabatanFungsional', JabatanFungsional::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Organisasi', Organisasi::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Pangkat', Pangkat::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Paten', Paten::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Prestasi', Prestasi::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Serdos', Serdos::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Skp', Skp::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
        ];
    }
}
