<?php

namespace Modules\Mix\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Mix\Http\Requests;

use Auth;
use Cache;
use Log;
use JavaScript;

use Modules\Mix\Entities\MixPlayer;
use Modules\Mix\Entities\Mix;
use Modules\Mix\Entities\KarmaVote;
use Modules\Mix\Entities\GameReport;

use Modules\User\Entities\{User};

class MixController extends Controller
{
    public function reset($id)
    {
        $mix = Mix::findOrFail($id);
        return $mix->resetGame();
    }

    public function mixespage(Request $request)
    {
        $page = $request->page;
        if (!Cache::has("LastMixes" . $page)) {
            $mixes = Mix::whereIn("game_status", [-1, 2])->orderBy("id", "desc")->paginate(30);

            foreach ($mixes as $mix) {
                $mix->getPlayers(true);
                $mix->getMap();
                $mix->getCreator();
            }
            Cache::put("LastMixes" . $page, $mixes, 1);
        } else {
            $mixes = Cache::get("LastMixes"  . $page);
        }

        JavaScript::put([
          'mixes' => $mixes
        ]);

        return view('mix::mixes');
    }

    public function showPage($id)
    {
        if (!Cache::has("MixDataPage" . $id)) {
            $mix = Mix::find($id);
            if (!$mix) {
                return redirect()->to('/');
            }

            $mix->getPlayers(true, true);
            $mix->getMap();
            $mix->getServer();
            $mix->server->getServerGroup();

            Cache::put("MixDataPage" . $id, $mix, 1);
        } else {
            $mix = Cache::get("MixDataPage" . $id);
        }

        JavaScript::put([
          'mix' => $mix,
          'mix_id' => $mix->id
        ]);
        return view("mix::mix");
    }


    public function json_data($id)
    {
        /*
         * mix json for game server
         * */

        $mixObj = Mix::find($id);

        $mixObj->getMap();
        $mixObj->getPlayers(true);
        $mixObj->getServer();

        $players = $mixObj->players;

        $team1_array = [];
        $team2_array = [];

        /*
         * fill team arrays
         * */
        foreach ($players as $player) {
            switch ($player->team) {
                case 1:
                /*$team1_array[] = str_replace("STEAM_0", "STEAM_1", $user->steamid);*/
                $team1_array[] = $player->user->steamid64;
                break;
                case 2:
                $team2_array[] = $player->user->steamid64;
                break;
            }
        }

        $team1name = preg_replace("/[^a-zA-Z0-9\s]/", '', $mixObj->team1name);
        $team2name = preg_replace("/[^a-zA-Z0-9\s]/", '', $mixObj->team2name);
        if (strlen($team1name) == 0) {
            $team1name = "Team 1";
        }

        if (strlen($team2name) == 0) {
            $team2name = "Team 2";
        }

        $mix = array(
            "matchid" => $id,
            "maps_to_win" => 1,
            "bo2_series" => false,
            "skip_veto" => true,
            "maplist" => array(
                $mixObj->map->name
                ),
            "players_per_team" => (int)$mixObj->per_team,
            /* "min_players_to_ready" => (int)$mixObj->per_team,*/
            "team1" => array(
                "name" => $team1name,
                // "flag" => "SE",
                //  "logo" => "nip",
                "matchtext" => "",
                "players" => $team1_array,
                ),
            "team2" => array(
                "name" => $team2name,
                // "flag" => "SE",
                //  "logo" => "nip",
                "matchtext" => "",
                "players" => $team2_array,
                ),
            "cvars" => array(
                "hostname" => "OVERPRO.RU SERVER " . $team1name . " vs " . $team2name,
                )
            );

        if ($mixObj->map->type == "AIM") {
            $mix['cvars']['mp_freezetime'] = "0";
            $mix['cvars']['mp_free_armor'] = "1";
            $mix['side_type'] = "never_knife";
        } else {
            $mix['cvars']['mp_freezetime'] = "15";
            $mix['cvars']['mp_free_armor'] = "0";
            $mix['side_type'] = "always_knife";
        }
        $mix['cvars']['get5_web_api_key'] = md5($id . $mixObj->server->address);

        return json_encode($mix);
    }

    public function karmaVote($id, Request $request)
    {
        $mix = (object)Mix::getMix($id);
        if ($mix) {
            $user = (object)User::getUser($request->user_id);
            if ($user) {
                $user_id = Auth::user()->id;
                if ($user->id == $user_id) {
                    return ['error'=> true, 'message' => "Нельзя менять карму самому себе"];
                }
                if (!in_array($request->value, ['-', '+'])) {
                    return ['error'=> true, 'message' => "Данные испорчены"];
                }

                $mix->getPlayers();
                $flag = false;
                $flag2 = false;
                $target = null;
                foreach ($mix->players as $player) {
                    if ($player->user_id == $request->user_id) {
                        $flag = true;
                        $target = $player;
                    }
                    if ($player->user_id == $user_id) {
                        $flag2 = true;
                    }
                }
                if (!$flag2) {
                    return ['error'=> true, 'message' => "Вы не учавствовали в данной игре"];
                }
                if (!$flag) {
                    return ['error'=> true, 'message' => "Данного игрока не было в этой игре"];
                }

                $prev = KarmaVote::where([["user_id", Auth::user()->id], ["target_id", $request->user_id]])->exists();
                if ($prev) {
                    $target->setKarma();
                    return ['error'=> false, 'message' => $target->karma];
                }
                $user = User::find($request->user_id);
                $user->karma += $request->value == '-' ? -1 : 1;
                $user->save();
                $vote = new KarmaVote();
                $vote->user_id = Auth::user()->id;
                $vote->target_id = $request->user_id;
                $vote->value = $request->value == '-' ? -1 : 1;
                $vote->mix_id = $id;
                $vote->comment = $request->text;
                $vote->save();
                $target->setKarma();
                return ['error'=> false, 'message' => $target->karma];
            } else {
                return ['error'=> true, 'message' => "Игрок не найден"];
            }
        } else {
            return ["error" => true, "message" => "Игра не найдена"];
        }
    }

    public function statsReceivePlayer($id, $mapid, $steam, Request $request)
    {
        $user = User::getUseridBySteam64($steam);
        if ($user) {
            $player = MixPlayer::where("user_id", $user)->orderBy("id", "desc")->first();
            $player->kills = $request->kills;
            $player->deaths = $request->deaths;
            $player->assists = $request->assists;
            $player->flashbang_assists = $request->flashbang_assists;
            $player->teamkills = $request->teamkills;
            $player->suicides = $request->suicides;
            $player->damage = $request->damage;
            $player->headshot_kills = $request->headshot_kills;
            $player->roundsplayed = $request->roundsplayed;
            $player->bomb_defuses = $request->bomb_defuses;
            $player->bomb_plants = $request->bomb_plants;
            $player->{'1kill_rounds'} = $request->{'1kill_rounds'};
            $player->{'2kill_rounds'} = $request->{'2kill_rounds'};
            $player->{'3kill_rounds'} = $request->{'3kill_rounds'};
            $player->{'4kill_rounds'} = $request->{'4kill_rounds'};
            $player->{'5kill_rounds'} = $request->{'5kill_rounds'};
            $player->{'v1'} = $request->{'v1'};
            $player->{'v2'} = $request->{'v2'};
            $player->{'v3'} = $request->{'v3'};
            $player->{'v4'} = $request->{'v4'};
            $player->{'v5'} = $request->{'v5'};
            $player->firstkill_t = $request->firstkill_t;
            $player->firstkill_ct = $request->firstkill_ct;
            $player->firstdeath_t = $request->firstdeath_t;
            $player->firstdeath_ct = $request->firstdeath_ct;
            $player->tradekill = $request->tradekill;
            $nick = preg_replace("/[^a-zA-Zа-яА-Я0-9]+/", "", $request->name);
            $player->name_on_server = $nick;
            $player->save();
        }
    }

    public function updateState($id, $mapid, Request $request)
    {
        $mix = Mix::find($id);
        $mix->score = $request->team1score . ":" . $request->team2score;
        $mix->save();
    }

    public function mapStart($id, $mapid, Request $request)
    {
        $mix = Mix::find($id);
        $mix->game_status = 1;
        $mix->save();
        $mix->getServer();
        Log::info(date("Y-m-d h:i:s") . ": Начало матча №" . $id . ". Сервер: " . $mix->server->address);
    }

    public function mapFinish($id, $mapid, Request $request)
    {
        $mix = Mix::find($id);
        $mix->getServer();
        Log::info(date("Y-m-d h:i:s") . ": Окончание карты в матче №" . $id . ". Сервер: " . $mix->server->address);
        if ($request->winner != 'none') {
            $score = $request->team1score . ":" . $request->team2score;
            $winner = $request->winner == "team1" ? 1 : 2;
            $mix->changeStatus(2, ["Победа в игре", "Поражение в игре"], $winner, $score, false, false);
        }
    }

    public function seriesStart($id, Request $request)
    {
        $mix = Mix::find($id);
        $mix->getServer();
        $mix->getLobby();
        Log::info(date("Y-m-d h:i:s") . ": Начало серии. Матч: " . $id . ". Сервер: " . $mix->server->address);
        $mix->lobby->message("Игра началась на сервере " . $mix->server->address . " . У игроков есть 5 минут, чтобы зайти на сервер.");
    }

    public function seriesFinish($id, Request $request)
    {
        $mix = Mix::find($id);
        $mix->getServer();
        $mix->server->state = 0;
        $mix->server->save();
        Log::info(date("Y-m-d h:i:s") . ": Окончание матча №" . $id . ". Сервер: " . $mix->server->address);

        if ($request->winner == "none" && $request->forfeit == 1) {
            $mix->changeStatus(-1, "Команды не успели зайти на сервер", null, null, false, true);
        }
    }

    public function playerReport($id, Request $request)
    {
        $mix = (object)Mix::getMix($id);
        if ($mix) {
            $user = (object)User::getUser($request->user_id);
            if ($user) {
                if ($user->id == Auth::user()->id) {
                    return ['error'=> true, 'message' => "Вы не можете жаловаться на самого себя"];
                }
                if (strlen($request->text) < 5) {
                    return ['error'=> true, 'message' => "Слишком короткое сообщение"];
                }
                $mix->getPlayers();
                $flag = false;
                $flag2 = false;
                foreach ($mix->players as $player) {
                    if ($player->user_id == $request->user_id) {
                        $flag = true;
                    }
                    if ($player->user_id == Auth::user()->id) {
                        $flag2 = true;
                    }
                }
                if (!$flag2) {
                    return ['error'=> true, 'message' => "Вы не учавствовали в данной игре"];
                }
                if (!$flag) {
                    return ['error'=> true, 'message' => "Данного игрока не было в этой игре"];
                }
                $prev = GameReport::where([["user_id", Auth::user()->id], ["report_id", $request->user_id]])->exists();
                if ($prev) {
                    return ['error'=> true, 'message' => "Вы уже жаловались на данного игрока в этой игре"];
                }
                $report = new GameReport();
                $report->user_id = Auth::user()->id;
                $report->report_id = $request->user_id;
                $report->mix_id = $id;
                $report->text = $request->text;
                $report->save();
                return ['error'=> false, 'message' => "Ваша жалоба успешно зарегистрирована!"];
            } else {
                return ['error'=> true, 'message' => "Игрок не найден"];
            }
        }
    }
}
