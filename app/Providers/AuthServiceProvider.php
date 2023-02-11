<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Event;
use App\Models\Role;
use App\Models\User;
use App\Policies\EventPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('if_company', function (User $user) {
            return $user->role_id === Role::IS_COMPANY;
        });
        Gate::define('if_visitor', function (?User $user) {
            return $user == null;
        });
        Gate::define('if_admin', function (User $user) {
            return $user->role_id === Role::IS_ADMIN;
        });
        Gate::define('if_admin_or_assistant', function (User $user) {
            return $user->role_id === Role::IS_ADMIN ||
                $user->role_id === Role::IS_ASSISTANT;
        });
    }
}