<?php

namespace Modules\Mix\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;

use gries\Rcon\MessengerFactory as Rcon;

use Cache;
use Carbon;
use Log;
use DB;

use Modules\Mix\Entities\Lobby;
use Modules\Mix\Entities\LobbyPlayer;
use Modules\Mix\Entities\Mix;
use Modules\Mix\Entities\MixServer;
use Modules\User\Entities\{User};
use Modules\Mix\Events\GameStart;
use Modules\Mix\Events\ReadyFailed;

class LobbiesHandlerEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $lobbies;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $lobbies_all = Lobby::all();
        $players_all = LobbyPlayer::all();

        $dropped = [];
        foreach ($lobbies_all as &$lobby) {
            if ($lobby->state != 1) {
                continue;
            }
            $players = $players_all->filter(function ($value, $key) use ($lobby) {
                return $value->lobby_id == $lobby->id && $value->ready == 1;
            });
            $players = sizeof($players);
            if ($players == ($lobby->per_team * 2)) {
                $server = MixServer::where([["state", 0], ['location_id', $lobby->location_id], ['updated_at', '<', Carbon::now()->subMinutes(3)]])->orderBy("updated_at", "asc")->first();
                if (!$server) {
                    $lobby->message("К сожалению, на данный момент нет свободных серверов. Повторная попытка через 5 секунд.");
                } else {
                    try {
                        list($ip, $port) = explode(":", $server->address);
                        $server->state = 1;
                        $server->save();
                        $messenger = Rcon::create($ip, $port, 'o7UviBXrAJ');
                        event(new GameStart($lobby->id, $lobby->per_team, $server));
                        Log::info("Запуск лобби № " . $lobby->id . " на сервере " . $server->address);
                    } catch (\Exception $e) {
                        Log::error("Сервер " . $server->address . " не доступен. Ошибка: " . $e->getMessage());
                    }
                }
            } elseif (strtotime($lobby->vote_ends) < strtotime(Carbon::now())) {
                $lobby->message("Не все игроки подтвердили готовность вовремя");
                event(new ReadyFailed($lobby->id));
                $dropped[] = $lobby->id;
            }
        }

        foreach ($lobbies_all as &$lobby) {
            if ($lobby->state != 0) {
                continue;
            }
            if (in_array($lobby->id, $dropped)) {
                continue;
            }


            if (abs(strtotime(Carbon::now()) - strtotime($lobby->created_at)) > 1800 && $lobby->state == 0) {
                $dropped[] = $lobby->id;
                $lobby->disband();
            }
            $players = $players_all->filter(function ($value, $key) use ($lobby) {
                return $value->lobby_id == $lobby->id;
            });
            $players = sizeof($players);
            if ($players == ($lobby->per_team * 2)) {
                $lobby->state = 1;
                $lobby->message("Запущена проверка готовности. У игроков есть 45 секунд подтвердить готовность");
                $lobby->vote_ends = Carbon::now()->addSeconds(45);
                $lobby->save();
            }
            if ($players == 0) {
                $dropped[] = $lobby->id;
                $lobby->disband();
            }
        }

        $lobbies_all = $lobbies_all->filter(function ($value, $key) use ($dropped) {
            return !in_array($value->id, $dropped);
        });

        foreach ($lobbies_all as &$lobby) {
            $lobby->players = $players_all->filter(function ($value, $key) use ($lobby) {
                return $value->lobby_id == $lobby->id;
            });
            $lobby->validate();
        }

        $this->lobbies = $lobbies_all->toArray();
        Cache::forever("CurrentLobbies", $this->lobbies);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('Lobbies');
    }

    public function broadcastAs()
    {
        return "refresh";
    }
}
