<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('manage-question-formats', function ($user){
            if($user->email == 'gerrit.thomson@gmail.com') {
                return true;
            }
            return false;
        });

        $gate->define('manage-quantifiable-observables', function ($user){
            if($user->email == 'gerrit.thomson@gmail.com') {
                return true;
            }
            return false;
        });

        $gate->define('manage-answers', function ($user){
            if($user->email == 'gerrit.thomson@gmail.com') {
                return true;
            }
            return false;
        });

        $gate->define('edit-scene', function ($user){
            if($user->email == 'gerrit.thomson@gmail.com') {
                return true;
            }
            return false;
        });

        $gate->define('create-scene', function ($user){
            if($user->email == 'gerrit.thomson@gmail.com') {
                return true;
            }
            return false;
        });
        //
    }
}
