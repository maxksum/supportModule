<?php

namespace Modules\Support\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TicketEvent implements ShouldBroadcast
{

    public $ticket;
    public $action;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticket, $action)
    {
        $this->ticket = $ticket;
        $this->action = $action;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
     public function broadcastOn()
     {
         return ['Ticket'];
     }

     public function broadcastAs()
     {
        return $this->action;
     }
}
