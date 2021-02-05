<?php

namespace Modules\User\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Carbon, Log;

use Modules\User\Entities\{User};
use Modules\Mix\Entities\{Mix};
use Modules\Mix\Entities\{Lobby};
use Illuminate\Broadcasting\Channel;

class UserWasUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $user;
    private $user_id;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct($user)
    {
        $this->user = User::find($user);
        $this->user->initStats();
        $this->user_id = $this->user->id;

        if (in_array($this->user->state,[1, 2])) {
            if ($this->user->state == 1) {
                $lobby = Lobby::find($this->user->current_game_id);
            } else {
                $mix = Mix::find($this->user->current_game_id);
                $lobby = Lobby::find($mix->lobby_id);
            }

            if ($lobby) {
              $lobby->validate();
              $this->user->lobby = $lobby;
            }
        }
        $this->user = $this->user->toArray();
    }


    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('User' . $this->user_id);
    }

    public function broadcastAs()
    {
      return 'updated';
    }
}
