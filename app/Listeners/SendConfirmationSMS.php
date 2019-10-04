<?php

namespace App\Listeners;

use App\Events\TodoCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendConfirmationSMS
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TodoCompleted  $event
     * @return void
     */
    public function handle(TodoCompleted $event)
    {
        \Log::info('Todo completed by ' . $event->data['user'] . ' sending via sms');
    }
}
