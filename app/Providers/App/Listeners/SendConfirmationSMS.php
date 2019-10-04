<?php

namespace App\Providers\App\Listeners;

use App\Providers\App\Events\TodoCompleted;
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
        //
    }
}
