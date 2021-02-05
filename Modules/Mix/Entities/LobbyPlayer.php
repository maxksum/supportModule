<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\User\Entities\{User};
use Modules\Mix\Entities\{Lobby};
use Config;

class LobbyPlayer extends Model
{
    public function removeFromLobby()
    {
        User::changeBalance($this->user_id, Config::get("mix.product_id"), $this->bet, -1 * $this->bet, 2);
        $tmp = User::find($this->user_id);
        $tmp->state = 0;
        $tmp->current_game_id = null;
        $tmp->save();
        $this->delete();
        return $tmp->name;
    }

    public function removeFromLobbyByUser($lobby)
    {
        $name = $this->removeFromLobby();
        if ($lobby->state == 1) {
            $lobby->state = 0;
            $lobby->save();
            self::where("lobby_id", $lobby->id)->update(['ready' => 0]);
        }
        return $name;
    }

	public function setUser() {
      $this->user = (object)User::getUser($this->user_id);
    }


}
