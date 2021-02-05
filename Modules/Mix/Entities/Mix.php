<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;

use gries\Rcon\MessengerFactory as Rcon;
use GuzzleHttp\Client as Guzzle;
use Carbon;
use Log;
use Cache;
use Config;
use Module;
use Modules\Core\Entities\Operation;
use Modules\Core\Entities\Map;
use Modules\Mix\Entities\Lobby;
use Modules\Mix\Entities\LobbyPlayer;
use Modules\Mix\Entities\MixServer;
use Modules\Mix\Entities\MixPlayer;
use Modules\Referral\Entities\{RefOperation};
use Modules\User\Entities\{User};
use Modules\Referral\Entities\{Referral};

class Mix extends Model
{
    protected $with = ['best'];

    public function best()
    {
        return $this->hasOne('Modules\User\Entities\User', 'id', 'best_player');
    }

    public static function getMix($id)
    {
        if (!Cache::has("MixData" . $id)) {
            $mix = self::find($id);
            if ($mix) {
                Cache::put("MixData" . $id, $mix, 1);
            }
        } else {
            $mix = Cache::get("MixData" . $id);
        }
        return $mix;
    }

    public function checkServer()
    {
        if (!$this->server) {
            $this->getServer();
        }
        list($ip, $port) = explode(":", $this->server->address);
        $flag = true;
        $counter = 0;
        while ($flag && $counter < 3) {
            try {
                $messenger = Rcon::create($ip, $port, 'o7UviBXrAJ');
                return $messenger;
            } catch (\Exception $e) {
                Log::error("Сервер " . $this->server->address . " не доступен. Ошибка: " . $e->getMessage());
                $counter++;
            }
        }

        if ($counter == 3) {
            return false;
        }

        return true;
    }

    public function resetGame($message = "Сброс администратором")
    {
        if ($this->game_status == -1) {
            return ["result" => false, "message" => "Игра уже сброшена"];
        }
        $this->changeStatus(-1, $message, null, null, true);
        return ["result" => true];
        return ["result" => false, "message" => "Игра не найдена"];
    }

    public function addEac()
    {
        if (!$this->server) {
            $this->getServer();
        }
        list($ip, $port) = explode(":", $this->server->address);

        $flag = true;
        $counter = 0;
        while ($flag && $counter < 3) {
            try {
                $res = new Guzzle();
                $res = $res->post('https://esports-front.easyanticheat.net/api/v2/leagues/168/servers/', [
          'headers' => [
              'X-SECRET-KEY' => 'MVI3NMIb02dcmXNBtlrMy0XulUkRtbZF',
          ],
          'json' => [
              "servers" =>
              [
                  [
                      "ip" => $ip,
                      "port" => $port,
                      "password" => "o7UviBXrAJ"
                  ]
              ]
          ]
      ]);
                $flag = false;
            } catch (\Exception $e) {
                Log::error("Не удалось подключить EAC к серверу " . $this->server->address . ". Ошибка: " . $e->getMessage());
                $counter++;
            }
        }
    }

    public function removeEac()
    {
        if (!$this->server) {
            $this->getServer();
        }
        list($ip, $port) = explode(":", $this->server->address);

        $flag = true;
        $counter = 0;
        while ($flag && $counter < 3) {
            try {
                $client = new Guzzle();
                $client = $client->request('DELETE', 'https://esports-front.easyanticheat.net/api/v2/leagues/168/servers/' . $this->server->address . '/', [
          'headers' => [
              'X-SECRET-KEY' => 'MVI3NMIb02dcmXNBtlrMy0XulUkRtbZF',
          ]
      ]);
                $flag = false;
            } catch (\Exception $e) {
                Log::error("Не удалось отключить EAC от сервера " . $this->server->address . ". Ошибка: " . $e->getMessage());
                $counter++;
            }
        }
    }

    public function startGame()
    {
        if (!$this->server) {
            $this->getServer();
        }
        if (!$this->lobby) {
            $this->getLobby();
        }
        list($ip, $port) = explode(":", $this->server->address);

        $flag = true;
        $counter = 0;
        while ($flag && $counter < 3) {
            try {
                $messenger = Rcon::create($ip, $port, 'o7UviBXrAJ');
                $response = $messenger->send('sv_hibernate_when_empty 0;get5_loadmatch_url overpro.ru/mix/api/' . $this->id);
                $flag = false;
                $this->lobby->message("Началась конфигурация сервера. Этот процесс обычно занимает не более 30 секунд.");
            } catch (\Exception $e) {
                Log::error("Сервер " . $this->server->address . " не доступен. Ошибка: " . $e->getMessage());
                $counter++;
            }
        }

        if ($counter == 3) {
            $this->resetGame();
            return;
        }

        if ($this->eac == 1) {
            $this->addEac();
        }
    }

    public function finishGame()
    {
        list($ip, $port) = explode(":", $this->server->address);
        $flag = true;
        $counter = 0;
        while ($flag && $counter < 3) {
            try {
                $messenger = Rcon::create($ip, $port, 'o7UviBXrAJ');
                $messenger->send('get5_endmatch;sm_kick @all "Матч завершен";');
                $flag = false;
            } catch (\Exception $e) {
                Log::error("Сервер " . $this->server->address . " не доступен. Ошибка: " . $e->getMessage());
                $counter++;
            }
        }
    }

    public function getServer()
    {
        $this->server = MixServer::find($this->server_id);
        return;
    }

    public function getLobby()
    {
        $this->lobby = Lobby::find($this->lobby_id);
        return;
    }

    public function getCreator()
    {
        $this->creator = (object)User::getUser($this->creator_id);
    }

    public function getPlayers($loadusers = false, $loadkarma = false)
    {
        if (!Cache::has("Mixplayers" . $this->id)) {
            $this->players = MixPlayer::where("mix_id", $this->id)->get();
            Cache::put("Mixplayers" . $this->id, $this->players, 2);
        } else {
            $this->players = Cache::get("Mixplayers" . $this->id);
        }
        if ($loadkarma) {
            foreach ($this->players as &$player) {
                $player->setKarma();
            }
        }
        if ($loadusers) {
            foreach ($this->players as $key=>$player) {
                $this->players[$key]->setUser();
            }
        }
        return;
    }

    public function getMap()
    {
        if (!Cache::has("Map" . $this->map_id)) {
            $this->map = Map::find($this->map_id);
            $this->map->image = "/img/maps/" . $this->map->image;
            Cache::put("Map" . $this->map_id, $this->map, 30);
        } else {
            $this->map = Cache::get("Map" . $this->map_id);
        }
    }

    public function validateTeams()
    {
        if (!$this->players) {
            $this->getPlayers();
        }
        $team1 = false;
        $team2 = false;
        foreach ($this->players as $player) {
            if ($player->banned == 0 && $player->team == 1) {
                $team1 = true;
            }
            if ($player->banned == 0 && $player->team == 2) {
                $team2 = true;
            }
        }

        if ($team1 && $team2) {
            return 3;
        }
        if (!$team1 && $team2) {
            return 2;
        }
        if ($team1 && !$team2) {
            return 1;
        }
        if (!$team1 && !$team2) {
            return 1;
        }
    }

    public function changeStatus($status, $comment = "", $winner = null, $score = null, $force_end = null, $bans = null)
    {
        $this->game_status = $status;

        if ($winner) {
            $this->winner_team = $winner;
            $this->score = $score;
        }
        unset($this->server);
        unset($this->players);
        unset($this->map);

        if ($winner) {
            $best = MixPlayer::where("mix_id", $this->id)->orderBy("damage", "desc")->first();
            if ($status == 2) {
                $this->best_player = $best->user_id;
            }
        }

        $this->save();
        $this->getMap();
        $this->getPlayers();

        Lobby::destroy($this->lobby_id);
        LobbyPlayer::where("lobby_id", $this->lobby_id)->delete();

        $operations_array = [];
        $ref_operations_array = [];
        foreach ($this->players as $player) {
            $user = User::find($player->user_id);
            if ($user->state != -1) {
                $user->state = 0;
            }
            $user->current_game_id = null;

            if ($winner) {
                $user->csgo->games++;

                $user->csgo->kills += $player->kills;
                $user->csgo->deaths += $player->deaths;
                $user->csgo->assists += $player->assists;
                $user->csgo->flashbang_assists+= $player->flashbang_assists;
                $user->csgo->teamkills += $player->teamkills;
                $user->csgo->suicides += $player->suicides;
                $user->csgo->damage += $player->damage;
                $user->csgo->roundsplayed += $player->roundsplayed;
                $user->csgo->bomb_defuses += $player->bomb_defuses;
                $user->csgo->bomb_plants += $player->bomb_plants;
                $user->csgo->headshot_kills += $player->headshot_kills;
                $user->csgo->{'1kill_rounds'} += $player->{'1kill_rounds'};
                $user->csgo->{'2kill_rounds'} += $player->{'2kill_rounds'};
                $user->csgo->{'3kill_rounds'} += $player->{'3kill_rounds'};
                $user->csgo->{'4kill_rounds'} += $player->{'4kill_rounds'};
                $user->csgo->{'5kill_rounds'} += $player->{'5kill_rounds'};
                $user->csgo->{'v1'} += $player->{'v1'};
                $user->csgo->{'v2'} += $player->{'v2'};
                $user->csgo->{'v3'} += $player->{'v3'};
                $user->csgo->{'v4'} += $player->{'v4'};
                $user->csgo->{'v5'} += $player->{'v5'};
                $user->csgo->firstkill_t += $player->firstkill_t;
                $user->csgo->firstkill_ct += $player->firstkill_ct;
                $user->csgo->firstdeath_t += $player->firstdeath_t;
                $user->csgo->firstdeath_ct += $player->firstdeath_ct;
                $user->csgo->tradekill += $player->tradekill;
                $user->csgo->save();
            }


            if ($this->player_bet > 0 && $winner) {
                $user->csgo->exp += $player->exp_ratio;
            }



            if ($winner) {
                $def_exp = 50;

                if ($player->team == $winner) {
                    $sum = $this->player_bet * 1.80;
                    $operation = 3;
                    $comment_temp = $comment[0];
                    $ref = true;
                    $player->winner = 1;
                    $player->exp_ratio += $def_exp;
                    $player->save();
                    $user->csgo->wins++;
                    $user->csgo->exp += $def_exp;
                } else {
                    $comment_temp = $comment[1];
                    $sum = 0;
                    $operation = 4;
                    $ref = false;
                    $player->winner = 0;
                    $player->exp_ratio -= $def_exp;
                    $player->save();
                    $user->csgo->loses++;
                    $user->csgo->exp -= $def_exp;
                }
            } else {
                $comment_temp = $comment;
                $sum = $this->player_bet;
                $operation = 5;
                $ref = false;
            }

            if ($player->entered == 0 && $bans && $user->state != -1) {
                $user->state = -1;
                $user->banned_until = Carbon::now()->addMinutes(5);
                $user->ban_reason = "Невход в игру №" . $this->id;
                $comment_temp = "Не подключился, заблокирован вход в игры до " . $user->banned_until;
            }

            User::changeBalance($user->id, Config::get("mix.product_id"), $sum, -1 * $sum, $operation, $comment_temp);

            if ($this->game_status != -1) {
                if ($this->per_team == 5) {
                    $bonus = 8 * Config::get("core.money_multiplier");
                } else {
                    $bonus = 2 * Config::get("core.money_multiplier");
                }
                User::changeBalance($user->id, Config::get("mix.product_id"), $bonus, -1 * $bonus, 6, "Игра №" . $this->id);
            }

            if ($winner) {
                if ($user->csgo->exp < 100) {
                    $user->csgo->exp = 100;
                }

                if ($user->csgo->exp >= 18000) {
                    $user->csgo->exp = 17999;
                }

                $user->csgo->save();
            }


            if ($ref && $user->referrer_id && Module::has("Referral")) {
                Referral::change($user->id, $this->player_bet, 1);
            }
            $user->save();
        }
        Operation::insert($operations_array);


        $this->getServer();
        if ($force_end) {
            $this->finishGame();
        }

        if ($this->eac == 1) {
            $this->removeEac();
        }
    }
}
