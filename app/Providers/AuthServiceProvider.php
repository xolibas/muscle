<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-panel',function(User $user){
            return $user->isAdmin() || $user->isTrainer();
        });
        Gate::define('user-manage',function(User $user){
            return $user->isAdmin();
        });
    }
}
