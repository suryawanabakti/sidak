<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Auth\Login;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{

    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerRenderHook(
                'panels::body.end', // Hook untuk menampilkan di bawah konten
                fn() => view('filament.footer') // View custom untuk footer
            );
        });
    }


    public function panel(Panel $panel): Panel
    {

        return $panel
            ->brandLogo('/lambang.png')

            ->brandName('SIDAK')
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
            ->spa()
            ->renderHook(
                'panels::topbar.start',
                fn(): View => view('filament.header')
            )
            ->default()
            ->id('admin')

            ->path('admin')
            ->login(Login::class)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            // ->brandLogo(asset('lambang.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('lambang.png'))
            ->font('Poppins')
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    ->url('')
                    ->icon('heroicon-o-cog-6-tooth')
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->setTitle('My Profile')
                    ->setNavigationLabel('My Profile')
                    ->setNavigationGroup('Setting')
                    ->setIcon('heroicon-o-user')
                    ->setSort(10)
                    ->shouldRegisterNavigation(true)
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowBrowserSessionsForm()
                    ->shouldShowAvatarForm()
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ]); // Menyertakan view custom header;
    }
}
