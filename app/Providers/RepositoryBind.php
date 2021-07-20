<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\User\userListRepo;
use App\Repository\User\userListInterface;

class RepositoryBind extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(userListInterface::class, userListRepo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [
            userListInterface::class
        ];
    }
}
