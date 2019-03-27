<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Event
{
    use Dispatchable,  SerializesModels;

    public $user;
    public $datos;
    public $tipo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$datos,$tipo)
    {
        //
        $this->user = $user;
        $this->datos = $datos;
        $this->tipo = $tipo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
   
}
