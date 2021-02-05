<?php

namespace Modules\User\Events;

use Illuminate\Queue\SerializesModels;
use Cache, Carbon;
use Modules\User\Entities\{User};

class BansHandlerEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $users = User::where([["banned_until", "<", Carbon::now()], ["state", -1]])->update(['state' => 0, 'banned_until' => null, 'ban_reason' => null]);

        $users = User::where([["chatban_until", "<", Carbon::now()], ["chat_ban", 1]])->update(['chat_ban' => 0, 'chatban_until' => null, 'chatban_reason' => null]);

        $users = User::where("banned_until", ">", Carbon::now())->whereIn("state", [0, 1, 2])->update(['state' => -1]);
    }
}
