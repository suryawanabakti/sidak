<?php

namespace App\Providers\Filament;

use App\Filament\Tendik\Pages\DataTendik;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TendikPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandLogo('/lambang.png')
            ->brandName('SIDAK')
            ->sidebarCollapsibleOnDesktop()
            ->font('Poppins')
            ->renderHook('panels::body.start', fn() => '<style>
            .fi-topbar > nav {
            background: linear-gradient(90deg, #0D47A1, #42A5F5) !important;
                color: white !important;
            }
        </style>')
            ->renderHook(
                'panels::body.end',
                fn(): View => view('filament.footer')
            )
            ->brandLogoHeight('3rem')
            ->renderHook(
                'panels::topbar.start',
                fn(): View => view('filament.header')
            )
            ->id('tendik')
            ->path('tendik')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Tendik/Resources'), for: 'App\\Filament\\Tendik\\Resources')
            ->discoverPages(in: app_path('Filament/Tendik/Pages'), for: 'App\\Filament\\Tendik\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Tendik/Widgets'), for: 'App\\Filament\\Tendik\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
