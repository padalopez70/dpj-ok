<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Lib\Sistema\Permisos;
use App\Models\User;
use App\Models\UserPermiso;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;


            /* ESQUELETOR */
            $usuario = User::where('email', $email)->first();

            if($usuario)
            {
                if($usuario->estado == 0)
                {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('login')->with('error', 'Cuenta Suspendida');
                }

                //seteo los permisos del usuario y las sessiones de parametros;
                //Permisos::setSession();

                $permisos = UserPermiso::where('usuario_id',$usuario->id)->pluck('permiso_id')->toArray();
                array_unshift($permisos,0); //agrego el permiso 0 a todos los usuarios
                session(['permisos' => $permisos]);
                session(['user_id' => $usuario->id]);





            }
            /* ESQUELETOR */

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
