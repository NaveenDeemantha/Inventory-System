<?php

namespace App\Listeners;

use App\Mail\LoginAlert;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoginNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // $event->user is the user who logged in
        // We can get IP from request() helper
        $ipAddress = request()->ip();
        
        Mail::to($event->user->email)->send(new LoginAlert($event->user, $ipAddress));
    }
}
