<?php

namespace App\Providers;

use App\Models\Identity\User;
use App\Services\Tenancy\TenantContext;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TenantContext::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (User $user, string $token): string {
            return rtrim(config('app.frontend_url'), '/')."/reset-password?token={$token}&email={$user->getEmailForPasswordReset()}";
        });
    }
}
