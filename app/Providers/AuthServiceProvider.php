<?php

namespace App\Providers;

use App\Contracts\Likeable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // your policies...
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
