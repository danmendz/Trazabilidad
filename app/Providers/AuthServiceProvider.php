<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('acceder-admin', function ($user){
            return $user->role === User::ROLE_ADMINISTRADOR;
        });

        Gate::define('acceder-trabajador', function ($user){
            return $user->role === User::ROLE_TRABAJADOR;
        });

        Gate::define('acceder-usuario', function ($user){
            return $user->role === User::ROLE_USUARIO;
        });
    }
}