<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\StateTask;
use App\Models\Task;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\StateTaskPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class      => UserPolicy::class,
        Category::class  => CategoryPolicy::class,
        StateTask::class => StateTaskPolicy::class,
        Task::class      => TaskPolicy::class
    ];


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
