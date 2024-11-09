<?php

namespace Zaker\User\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Zaker\User\Models\User;
use Zaker\User\Repositories\Elequent\UserRepo;
use Zaker\User\Repositories\UserInterface;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerBindings();
        config()->set('auth.providers.users.model',User::class);
        config()->set('auth.resend_verification_code_time_diff');
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Databases/factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/','User');
    }

    private function registerBindings()
    {
        $this->app->bind(UserInterface::class,function (){
            return new UserRepo(new User);
        });
    }

    public function boot()
    {


    }
}
