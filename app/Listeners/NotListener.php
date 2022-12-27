<?php

namespace App\Listeners;

use App\Events\NotEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotListener
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
     * @param  NotEvent  $event
     * @return void
     */
    public function handle(NotEvent $event)
    {
        //
    }
}
