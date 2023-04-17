<?php

namespace App\Providers;
//namespace App\Lib\Sistema;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Lib\Sistema\Permisos;
use App\Models\Permiso;


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

        URL::defaults(['register' => true]);

        $this->registerPolicies();
        Gate::define('crear-expediente', function(){
            return Permisos::control(200);
        });

        $this->registerPolicies();
        Gate::define('administrador', function(){
            return Permisos::control(1);
        });
        //
    }
}
