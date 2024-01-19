<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\UserDetail;
use App\Policies\UserDetailPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserDetail::class => UserDetailPolicy::class,
    ];
    
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
        //
    }
}
