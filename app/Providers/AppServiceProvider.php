<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $user = auth()->user();
        Gate::before(function ($user, $ability) {
            return $user->roles->contains(function ($role) {
                return in_array(strtolower($role->name), ['super admin', 'admin']);
            }) ? true : null;
        });
        JsonResource::withoutWrapping();
        Vite::prefetch(concurrency: 3);
    }
}
