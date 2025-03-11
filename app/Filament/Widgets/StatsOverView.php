<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverView extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Dosen', User::where('role', 'dosen')->count()),
            Stat::make('Jumlah Tendik', User::where('role', 'tendik')->count()),
            Stat::make('Jumlah Pimpinan', User::where('role', 'pimpinan')->count()),
        ];
    }
}
