<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Filiere;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
                return $user->hasRole('admin');
        }); 
        
        Gate::define('isManager', function ($user) {
                return $user->hasRole('manager');
        }); 

        Gate::define('isTeacher', function ($user) {
                return $user->hasRole('teacher');
        });

        Gate::define('teachesMatiere', function ($user, $matiere) {
                return $user->hasMatiere($matiere);
        });

        Gate::define('matiereBelongsToFiliere', function ($user, $filiere, $matiere) {
                return $filiere->hasMatiere($matiere);
        });
    }
}
