<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
Use App\Mail\NotificationMail;

class EventListener
{
   
    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
            
        //dd($event);  
        Mail::to($event->user->email)->queue(
          
          new NotificationMail($event->user, $event->datos,$event->tipo)
        );
    }
}
