<?php

namespace Modules\Mix\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Core\Entities\{Map};
use Modules\User\Entities\{User};
use Modules\Mix\Entities\{Mix, MixServerLocation};
use Modules\Mix\Events\{LobbyEvent};
use Modules\Mix\Entities\{Lobby, LobbyPlayer};
use Modules\Mix\Jobs\{LobbyJob};

use Carbon, Auth, Cache, Config;

class LobbyController extends Controller
{
    private $techworks = false;

    public function reset()
    {
        $lobbies = Lobby::whereIn("state", [0, 1])->get();
        foreach ($lobbies as $lobby) {
            $lobby->disband();
        }
        return ['result' => true];
    }

    public function reset_id($id)
    {
        $lobby = Lobby::findOrFail($id);
        $lobby->disband();
        return ['result' => true];
    }

    private function validateSkills(&$from, &$to)
    {
      if ($from < 1) {
          $from = 1;
      }
      if ($from > 7) {
          $from = 7;
      }
      if ($to > 7) {
          $to = 7;
      }
      if ($to < 1) {
          $to = 1;
      }
      if ($from > $to) {
          $temp = $skill_from;
          $from = $to;
          $to = $temp;
      }
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if ($this->techworks) {
            if (!in_array($user->id, [1])) {
                return ["error" => true, "message" => "Технические работы"];
            }
        }
        if (in_array($user->state, [1, 2])) {
            return ["error" => true, "message" => "Вы уже находитесь в игре"];
        }
        if ($user->state == -1) {
            return ["error" => true, "message" => "Ваш аккаунт заблокирован по причине '" . $user->ban_reason . "' до " . $user->banned_until];
        }

        $team1name = $request->team1;
        $team2name = $request->team2;
        $bet = (int)$request->bet < 0 ? 0 : (int)$request->bet;
        $bet *= Config::get("core.money_multiplier");
        $per_team = $request->per_team ? $request->per_team : 0;
        $map = $request->map;
        $password = $request->password;
        $anticheat = $request->anticheat ? 1 : 0;
        $location = $request->location;
        $hidden = $request->hidden ? 1 : 0;
        $auto_balance = $request->autobalance ? 1 : 0;
        $skill_from = (int)$request->from;
        $skill_to = (int)$request->to;

        $this->validateSkills($skill_from, $skill_to);

        $rank = Auth::user()->csgo->getLobbyRank();

        if ($rank < $skill_from || $rank > $skill_to) {
          return ["error" => true, "message" => "Ваш скилл не входит в указанный диапазон"];
        }

        if (strlen($team1name) < 3) {
            return ["error" => true, "message" => "Слишком короткое название команды 1"];
        }

        if (strlen($team1name) > 10) {
            return ["error" => true, "message" => "Слишком длинное название команды 1"];
        }

        if (strlen($team2name) < 3) {
            return ["error" => true, "message" => "Слишком короткое название команды 2"];
        }

        if (strlen($team2name) > 10) {
            return ["error" => true, "message" => "Слишком длинное название команды 2"];
        }

        if (!$map) {
            return ["error" => true, "message" => "Вы не выбрали никакой карты"];
        }

        if ($user->money < $bet) {
            return ["error" => true, "message" => "У вас недостаточно поинтов, чтобы создать игру с такой ставкой"];
        }

        if (!in_array($per_team, [1, 2, 3, 4, 5])) {
            return ["error" => true, "message" => "Неверный формат игры"];
        }

        if (!Map::where([["id", $map],["active", 1]])) {
            return ["error" => true, "message" => "Выбранной карты не существует"];
        }

        if (!MixServerLocation::where([["id", $location], ['active', 1]])->exists()) {
            return ["error" => true, "message" => "Выбранной локации не существует"];
        }

		$user->create_form = serialize($request->except(['password']));
        $user->save();

        User::changeBalance($user->id, Config::get("mix.product_id"), -1 * $bet, $bet, 1, "", LobbyJob::class, [
          "type" => 1,
          "team1name" => $team1name,
          "team2name" => $team2name,
          "creator_id" => $user->id,
          "per_team" => $per_team,
          "map_id" => $map,
          "password" => $password,
          "location_id" => $location,
          "eac" => $anticheat,
          "players_hidden" => $hidden,
          "bet" => $bet,
          "auto_balance" => $auto_balance,
          "skill_from" => $skill_from,
          "skill_to" => $skill_to,
        ]);

        return ["error" => false];
    }

    public function kickPlayer(Request $request)
    {
        $user = Auth::user();
        if ($user->state != 1 || !$user->current_game_id) {
            return redirect()->to("/");
        }

        $kick = User::find($request->kick);
        if (!$kick) {
            return ["error" => true, "message" => "Игрока не существует"];
        }

        if ($kick->state != 1 || !$kick->current_game_id) {
            return ["error" => true, "message" => "Игрока нет в данном лобби"];
        }

        $lobby = Lobby::find($user->current_game_id);
        if (!$lobby) {
            return ["error" => true, "message" => "Лобби не найдено"];
        }
        $player = LobbyPlayer::where("user_id", $kick->id)->first();
        if ($user->id == $kick->id) {

          if ($lobby->state == 2) {
            return ["error" => true, "message" => "Игра уже началась"];
          }

          if ($lobby->creator_id == $user->id) {
            $lobby_old_creator = $lobby->creator_id;
            $players = LobbyPlayer::where("lobby_id", $lobby->id)->get();
            foreach ($players as $lobbyplayer) {
              if ($lobbyplayer->id != $lobby_old_creator) {
                $lobby->creator_id = $lobbyplayer->user_id;
                $lobby->save();
                break;
              }
            }
            if ($lobby->creator_id == $lobby_old_creator) {
              $lobby->disband();
              return ["error" => false, "message" => "Лобби успешно распущено"];
            }
            else {
              $player->removeFromLobbyByUser($lobby);
              return ["error" => false, "message" => "Вы покинули лобби"];
            }
          }
          else {
            $player->removeFromLobbyByUser($lobby);
            if ($lobby->players_hidden == 0) {
              $lobby->message("Игрок " . $kick->name . " покинул лобби");
            }
            else {
              $lobby->message("Игрок покинул лобби");
            }
            return ["error" => false, "message" => "Вы покинули лобби"];
          }
        } else {
            if ($lobby->creator_id != $user->id) {
                return ["error" => true, "message" => "Вы не создатель лобби"];
            }

            $name = $player->removeFromLobbyByUser($lobby);
            if ($lobby->players_hidden == 0) {
                $lobby->message("Игрок " . $name . " исключен из лобби создателем");
            } else {
                $lobby->message("Игрок был исключен из лобби создателем");
            }
            $kick->notify("Вы были исключены из лобби");
            return ["error" => false, "message" => "Игрок исключен из лобби"];
        }
    }

    public function movePlayer(Request $request)
    {
        $user = Auth::user();
        if ($user->state != 1 || !$user->current_game_id) {
            return redirect()->to("/");
        }

        $move = User::find($request->move);
        if (!$move) {
            return ["error" => true, "message" => "Игрока не существует"];
        }

        if ($move->state != 1 || !$move->current_game_id) {
            return ["error" => true, "message" => "Игрока нет в данном лобби"];
        }

        $lobby = Lobby::find($user->current_game_id);
        if (!$lobby) {
            return ["error" => true, "message" => "Лобби не найдено"];
        }

        if ($lobby->creator_id != $user->id) {
            if ($move->id != $user->id) {
                return ["error" => true, "message" => "Вы не создатель лобби"];
            }
        }

        if ($lobby->state == 2) {
            return ["error" => true, "message" => "Игра уже началась"];
        }

        $player = LobbyPlayer::where("user_id", $move->id)->first();

        $to = $player->team == 1 ? 2 : 1;
        $toname = $lobby->{"team" . $to . "name"};

        $count = LobbyPlayer::where([["lobby_id", $lobby->id], ["team", $to]])->count();
        if ($count == $lobby->per_team) {
            return ["error" => true, "message" => "В другой команде нет мест"];
        }

        $player->team = $to;
        $player->save();

        if ($lobby->players_hidden == 0) {
            $user = (object)User::getUser($player->user_id);
            $name = $user->name;
        } else {
            $name = "?????";
        }

        if ($lobby->players_hidden == 0) {
            $lobby->message("Игрок " . $name . " был перемещен в команду " . $toname);
        } else {
            $lobby->message("Игрок был перемещен в команду " . $toname);
        }


        return ["error" => false];
    }

    public function getLobbies()
    {
        $lobbies = Lobby::orderBy("created_at", "asc")->get();
        foreach ($lobbies as &$lobby) {
            $lobby->validate();
        }
        return $lobbies;
    }

    public function editLobby(Request $request)
    {
        $user = Auth::user();
        if ($user->state != 1 || !$user->current_game_id) {
            return redirect()->to("/");
        }

        $password = $request->password;

        $lobby = Lobby::find($user->current_game_id);
        if (!$lobby) {
            return ["error" => true, "message" => "Лобби не найдено"];
        }

        if ($lobby->creator_id != $user->id) {
            return ["error" => true, "message" => "Вы не создатель лобби"];
        }

        if ($lobby->state == 2) {
            return ["error" => true, "message" => "Игра уже началась"];
        }

        $lobby->password = $password;

        $lobby->message("Создать изменил настройки лобби");
        return ["error" => false];
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        if (!in_array($user->state, [1, 2])) {
            return redirect()->to("/");
        }
        if (Cache::has('lobbymsg_' . $user->id)) {
            $time = Cache::get('lobbymsg_' . $user->id);
            if ((strtotime($time) - strtotime(Carbon::now())) > 0) {
                return ["error" => true, 'message' => "Обнаружен спам сообщениями"];
            }
        }

        $msg = strip_tags($request->text);
        $msg = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $msg);
        if (mb_strlen($msg, 'UTF-8') > 200) {
            return ["error" => true, 'message' => "Слишком длинное сообщение"];
        }

        if (mb_strlen($msg, 'UTF-8') < 2) {
            return ["error" => true, 'message' => "Слишком короткое сообщение"];
        }

        if (empty(trim($msg))) {
            return ["error" => true, 'message' => "Нельзя отправлять пустые сообщения"];
        }

        if ($user->chat_ban) {
            return ["error" => true, 'message' => "Вам нельзя отправлять сообщения"];
        }

        $msg_array = explode(" ", $msg);
        $i = 0;

        while ($i < count($msg_array)) {
            if (mb_strlen($msg_array[$i]) > 20) {
                return ["error" => true, 'message' => "Вам нельзя отправлять сообщения"];
            }
            $i++;
        }

        $lobby_player = LobbyPlayer::where("user_id", $user->id)->first();
        $lobby = Lobby::find($lobby_player->lobby_id);
        if (!Cache::has("LobbyMessages" . $lobby_player->lobby_id)) {
            $id = 1;
        } else {
            $id = Cache::get("LobbyMessages" . $lobby_player->lobby_id);
            $id++;
        }
        Cache::put("LobbyMessages" . $lobby_player->lobby_id, $id, 30);

        $message = (object)null;
        $message->id = $id;
        $message->text = $request->text;
        if ($lobby->players_hidden == 1) {
            $message->user_id = -1;
            $message->name = "?????";
        } else {
            $message->user_id = $user->id;
            $message->name = $user->name;
        }
        $message->created_at = Carbon::now();
        event(new LobbyEvent("message", $message, $lobby_player->lobby_id, $lobby_player->user_id));
        Cache::put('lobbymsg_' . $user->id, 1, Carbon::now()->addSeconds(5));
        return ["error" => false];
    }

    public function joinLobby(Request $request)
    {
        $team = $request->team;
        $lobby_id = $request->lobby_id;
        $password = $request->password;

        if (!$lobby_id) {
            return ["error" => true, "message" => "Ошибка данных"];
        }
        if (!$team) {
            $team = 1;
        }
        if (!in_array($team, [1, 2])) {
            return ["error" => true, "message" => "Ошибка данных"];
        }

        $lobby = Lobby::find($lobby_id);
        if (!$lobby) {
            return ["error" => true, "message" => "Лобби больше не существует"];
        }

        if ($lobby->password != $password) {
            return ["error" => true, "message" => "Пароль введен неверно"];
        }

        $user = Auth::user();

        if ($this->techworks) {
            if (!in_array($user->id, [5,11])) {
                return ["error" => true, "message" => "Технические работы"];
            }
        }

        if ($user->state == -1) {
            return ["error" => true, "message" => "Ваш аккаунт заблокирован по причине '" . $user->ban_reason . "' до " . $user->banned_until];
        }

        if (in_array($user->state, [1, 2])) {
            return ["error" => true, "message" => "Вы уже находитесь в игре"];
        }

        $rank = $user->csgo->getLobbyRank();
        $allowed = $rank >= $lobby->skill_from && $rank <= $lobby->skill_to;
        if (!$allowed) {
            return ["error" => true, "message" => "Игрокам с вашим скиллом вход запрещен"];
        }

        if ($user->money < $lobby->bet) {
            return ["error" => true, "message" => "У вас недостаточно средств"];
        }

        $team_count = LobbyPlayer::where([["lobby_id", $lobby->id], ["team", $team]])->count();
        if ($team_count == $lobby->per_team) {
            return ["error" => true, "message" => "В этой команде больше нет мест"];
        }

        User::changeBalance($user->id, Config::get("mix.product_id"), -1 * $lobby->bet, $lobby->bet, 1, "", LobbyJob::class, [
          "type" => 2,
          "lobby" => $lobby,
          "team" => $team,
          "user" => $user
        ]);


        return ["error" => false];
    }

    public function ready()
    {
        $user = Auth::user();
        if ($user->state != 1 || !$user->current_game_id) {
            return redirect()->to("/");
        }

        $lobby = Lobby::find($user->current_game_id);
        if (!$lobby) {
            return ["error" => true, "message" => "Лобби больше не существует"];
        }
        if ($lobby->state != 1) {
            return ["error" => true, "message" => "На данный момент не производится подтверждение готовности"];
        }

        $lobby_player = LobbyPlayer::where("user_id", $user->id)->first();
        $lobby_player->ready = 1;
        $lobby_player->save();

        return ["error" => false];
    }
}
