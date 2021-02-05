<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;


use Modules\User\Entities\User;
use Modules\Mix\Entities\{LobbyPlayer, Mix};
use Modules\Mix\Events\LobbyEvent;
use Modules\Core\Entities\{Map};
use Cache, Carbon, Config;

class Lobby extends Model
{
    protected $with = ['location'];

    public function location()
    {
        return $this->hasOne('Modules\Mix\Entities\MixServerLocation', 'id', 'location_id');
    }

    public function getPlayers() {
      $this->players = LobbyPlayer::where("lobby_id", $this->id)->get();
    }

    public function setSkills()
    {
      switch ($this->skill_from) {
        case 1:
          $this->skill_from = 'LS';
          break;
        case 2:
          $this->skill_from = 'MS';
          break;
        case 3:
          $this->skill_from = 'AS';
          break;
        case 4:
          $this->skill_from = 'HS';
          break;
        case 5:
          $this->skill_from = 'SS';
          break;
        case 6:
          $this->skill_from = 'PS';
          break;
        case 7:
          $this->skill_from = 'OP';
          break;
      }
      switch ($this->skill_to) {
        case 1:
          $this->skill_to = 'LS';
          break;
        case 2:
          $this->skill_to = 'MS';
          break;
        case 3:
          $this->skill_to = 'AS';
          break;
        case 4:
          $this->skill_to = 'HS';
          break;
        case 5:
          $this->skill_to = 'SS';
          break;
        case 6:
          $this->skill_to = 'PS';
          break;
        case 7:
          $this->skill_to = 'OP';
          break;
      }
    }

    public function disband()
    {
        $players = LobbyPlayer::where("lobby_id", $this->id)->get();
        foreach ($players as $player) {
            $player->removeFromLobby();
        }
        $this->delete();
    }

    public function message($text)
    {
        if (!Cache::has("LobbyMessages" . $this->id)) {
            $id = 1;
        } else {
            $id = Cache::get("LobbyMessages" . $this->id);
            $id++;
        }
        Cache::put("LobbyMessages" . $this->id, $id, 30);
        $message = (object)null;
        $message->id = $id;
        $message->text = $text;
        $message->user_id = 0;
        $message->name = "SYSTEM";
        $message->created_at = Carbon::now();
        event(new LobbyEvent("message", $message, $this->id));
    }

    public function validate() {
      if ($this->password) {
          $this->password = true;
      }
      if ($this->players_hidden == 1) {
          $this->creator = (object)null;
          $this->creator->name = "?????";
      } else {
          $this->creator = User::getUser($this->creator_id);
      }
      if (!isset($this->players)) {
        $this->players = LobbyPlayer::where("lobby_id", $this->id)->get();
      }
      $team1 = [];
      $team2 = [];
      foreach ($this->players as $key2=>$player) {
          if ($this->players_hidden == 1) {
              $this->players[$key2]->user = (object)null;
              $this->players[$key2]->user->name = "?????";
              $this->players[$key2]->user->own_rank = "NO";
              $this->players[$key2]->user->own_rank_full = "Ранк скрыт";
              $this->players[$key2]->user->id = -1;
              $this->players[$key2]->user->avatar_medium = "/images/anonymous.png";
              $this->players[$key2]->user->avatar_full = "/images/anonymous.png";
              $this->players[$key2]->user->role = "Неизвестно";
              $this->players[$key2]->user->steamid = "Неизвестно";
              $this->players[$key2]->user->steamid64 = "Неизвестно";
          } else {
              $this->players[$key2]->setUser();
          }
          if ($this->players[$key2]->team == 1) {
              $team1[] = $this->players[$key2];
          } else {
              $team2[] = $this->players[$key2];
          }
      }
      unset($this->players);
      $this->team1 = $team1;
      $this->team2 = $team2;
      $this->map = Map::getMap($this->map_id);

      if ($this->state == 2) {
          $this->mix = Mix::getMix($this->mix_id);
          $this->mix->getServer();
          $this->time = round((strtotime(Carbon::now()) - strtotime($this->mix->created_at)) / 60);
      } else {
          $this->time = round((strtotime(Carbon::now()) - strtotime($this->created_at)) / 60);
      }

      $this->prize = floor($this->bet / Config::get("core.money_multiplier") * 1.80);
      if ($this->per_team == 5) {
        $this->prize += 8;
      } else {
        $this->prize += 2;
      }

      $this->setSkills();
    }

    public static function getLobby($id)
    {
        if (!Cache::has("Lobby" . $id)) {
            $lobby = self::find($id);
            Cache::put("Lobby" . $id, $lobby, 5);
        } else {
            $lobby = Cache::get("Lobby" . $id);
        }

        $lobby->validate();

        return $lobby;
    }
}
