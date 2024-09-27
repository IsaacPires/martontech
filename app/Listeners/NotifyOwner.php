<?php

namespace App\Listeners;

use App\libraries\Discord;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOwner
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $discord = new Discord();
                
        $discord->sendMensagem($event->orders->owner_id, $event->content, $event->orders->getKey());
    }
}
