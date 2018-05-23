<?php

namespace App\Providers;

use App\Competition;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('enter-competition', function (User $user, Competition $competition) {
            if ($competition->isOver() || $competition->isUpcoming()) {
                return false;
            }

            return $user->isParticipating($competition);
        });
    }
}
