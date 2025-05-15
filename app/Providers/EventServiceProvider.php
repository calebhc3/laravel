<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use App\Listeners\SendResetPasswordEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PasswordReset::class => [
            SendResetPasswordEmail::class,
        ],
    ];
}
