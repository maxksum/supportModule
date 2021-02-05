<?php

namespace Modules\Mix\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Modules\Mix\Entities\Lobby;

class LobbyEvent implements ShouldBroadcast
{
    use SerializesModels;

    private $action;
    public $data;
    private $lobby_id;
    private $lobby;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, $data, $lobby_id, $user_id = 0)
    {
        //
        $this->action = $action;

        $this->data = $data;

        $this->lobby_id = $lobby_id;

        $this->lobby = Lobby::getLobby($this->lobby_id);

        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['Lobby' . $this->lobby_id];
    }

    public function broadcastAs()
    {
      return $this->action;
    }
}
