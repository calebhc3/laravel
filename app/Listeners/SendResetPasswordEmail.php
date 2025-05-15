<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class SendResetPasswordEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PasswordReset $event)
    {

    }
}
