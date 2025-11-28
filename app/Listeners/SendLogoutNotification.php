<?php

namespace App\Listeners;

use App\Mail\LogoutAlert;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLogoutNotification
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
    public function handle(Logout $event): void
    {
        if ($event->user) {
            Mail::to($event->user->email)->send(new LogoutAlert($event->user));
        }
    }
}
