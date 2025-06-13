<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Festival;
use App\Models\Ticket;
use App\Policies\FestivalPolicy;
use App\Policies\TicketPolicy;
use App\Models\Order;
use App\Policies\OrderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Festival::class => FestivalPolicy::class,
        Ticket::class => TicketPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for managing festivals and tickets
        Gate::define('manage-festivals', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-tickets', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-orders', function ($user) {
            return $user->hasRole('admin');
        });

        // Implicitly grant "admin" role all permissions
        Gate::before(function ($user, $ability) {
            return $user->isAdmin() ? true : null;
        });
    }
} 