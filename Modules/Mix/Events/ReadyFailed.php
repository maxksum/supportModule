<?php

namespace Modules\Mix\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Modules\Mix\Entities\{LobbyPlayer, Lobby};
use Modules\User\Entities\{User};

use Carbon;

class ReadyFailed
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lobby_id)
    {
        //
        $this->lobby_id = $lobby_id;

        $lobby = Lobby::find($lobby_id);

        if (!$lobby) {
            return;
        }

        if (strtotime($lobby->vote_ends) > strtotime(Carbon::now())) {
            return;
        }

        $players = LobbyPlayer::where("lobby_id", $this->lobby_id)->get();
        $captain_not_ready = false;
        if (sizeof($players) == ($lobby->per_team * 2)) {
            $count = 0;
            $not_ready = [];
            foreach ($players as $key=>$player) {
                if ($player->ready == 1) {
                    $count++;
                } else {
                    $not_ready[] = $player;
                    unset($players[$key]);
                    if ($player->user_id == $lobby->creator_id) {
                        $captain_not_ready = true;
                    }
                }
            }

            if ($captain_not_ready) {
              foreach ($players as $key=>$player) {
                if ($player->ready == 1) {
                  $lobby->creator_id = $player->user_id;
                  $lobby->save();
                  $captain_not_ready = false;
                  break;
                }
              }
            }

            if ($captain_not_ready) {
              $lobby->disband();
            }

            if ($count != ($lobby->per_team * 2)) {
                $lobby->state = 0;
                $lobby->save();

                foreach ($players as $player) {
                    $player->ready = 0;
                    $player->save();
                }

                foreach($not_ready as $player) {
                    $user = User::find($player->user_id);
                    $user->notify("Вы были исключены из лобби, так как не подтвердили готовность вовремя");
                    $player->removeFromLobby();
                }

                return;
            }

        } else {
            $lobby->state = 0;
            $lobby->save();
            foreach ($players as $player) {
                $player->ready = 0;
                $player->save();
            }
            return;
        }
    }

    public function broadcastOn()
    {
        return [];
    }
}
