<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(CourseService::class, CourseServiceImpl::class);
        $this->app->bind(CourseRepository::class, CourseRepositoryImpl::class);

        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);      
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
}
