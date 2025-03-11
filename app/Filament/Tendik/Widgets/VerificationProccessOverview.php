<?php

namespace App\Filament\Tendik\Widgets;

use App\Models\Ijazah;
use App\Models\Serdos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VerificationProccessOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Jumlah Ijazah', Ijazah::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),
            Stat::make('Jumlah Sertifikat', Serdos::where('user_id', auth()->id())->where('status', 'proses')->count())->description('Belum di verifikasi'),

        ];
    }
}
