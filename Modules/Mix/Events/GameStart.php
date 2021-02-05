<?php

namespace Modules\Mix\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Modules\User\Entities\{User};
use Modules\Mix\Entities\Mix;
use Modules\Mix\Entities\MixPlayer;
use Modules\Mix\Entities\Lobby;
use Modules\Mix\Entities\LobbyPlayer;
use Modules\Core\Entities\{Operation};
use Modules\Mix\Events\LobbyEvent;
use Cache;
use Carbon;

class GameStart
{
    use SerializesModels;

    private $max;


    public function calculateTeamScore($team, $exp, $per_team)
    {
        global $exp;
        $players = [];
        $score = 0;
        for ($i = 0; $i < ($per_team * 2); ++$i) {
            if (($team & 1) == 1) {
                $score += $exp[$i];
                $players[] = $i;
            }
            $team = $team >> 1;
        }
        return [$players, $score];
    }

    public function isValidTeam($team, $per_team)
    {
        $count = 0;
        for ($i = 0; $i < ($per_team * 2); ++$i) {
            if (($team & 1) == 1) {
                ++$count;
            }
            $team = $team >> 1;
        }
        return ($count == $per_team);
    }

    public function balance($exps, $per_team)
    {
        global $teams;


        $min = null;
        $min_players = null;
        for ($team = 0; $team < 512; ++$team) {
            if ($this->isValidTeam($team, $per_team)) {
                $opposingTeam = ~$team;
                $teamScore = $this->calculateTeamScore($team, $exps, $per_team);
                $opposingTeamScore = $this->calculateTeamScore($opposingTeam, $exps, $per_team);
                $scoreDiff = abs($teamScore[1] - $opposingTeamScore[1]);
                if (!$min) {
                    $min = $scoreDiff;
                    $min_players[1] = $teamScore[0];
                    $min_players[2] = $opposingTeamScore[0];
                } elseif ($min > $scoreDiff) {
                    $min = $scoreDiff;
                    $min_players[1] = $teamScore[0];
                    $min_players[2] = $opposingTeamScore[0];
                }
            }
        }
        return $min_players;
    }


    public function __construct($id, $per_team, $server)
    {
        $lobby = Lobby::find($id);

        $players = LobbyPlayer::where("lobby_id", $lobby->id)->get();

        $this->max = $per_team * 2;

        if (sizeof($players) != $this->max) {
            $lobby->state = 0;
            $lobby->save();
            foreach ($players as $player) {
                $player->ready = 0;
                $player->save();
            }
            return;
        }

        $exps = [];
        $users = [];

        if ($lobby->auto_balance == 1 && $lobby->per_team > 1) {
            foreach ($players as $player) {
                $user = User::find($player->user_id);
                $exps[] = $user->csgo->exp;
                $users[] = $user->id;
            }
            $result = $this->balance($exps, $lobby->per_team);
            $balanced = [];
            foreach ($result as $key=>$team) {
                foreach ($team as $player) {
                    $balanced[$key][] = $users[$player];
                }
            }

            foreach ($balanced as $key=>$team) {
                foreach ($team as $player) {
                    $lobby_pl = LobbyPlayer::where("user_id", $player)->first();
                    if ($team != $lobby_pl->team) {
                        $lobby_pl->team = $key;
                        $lobby_pl->save();
                    }
                }
            }
            $lobby->message("Команды были сбалансированы.");
        }

        $players = LobbyPlayer::where("lobby_id", $lobby->id)->get();


        $mix = new Mix();
        $mix->creator_id = $lobby->creator_id;
        $mix->map_id = $lobby->map_id;
        $mix->team1name = $lobby->team1name;
        $mix->team2name = $lobby->team2name;
        $mix->game_status = 0;
        $mix->player_bet = $lobby->bet;
        $mix->per_team = $lobby->per_team;
        $mix->eac = $lobby->eac;
        $mix->auto_balance = $lobby->auto_balance;
        $mix->players_hidden = $lobby->players_hidden;
        $mix->lobby_id = $lobby->id;
        if ($server) {
            $mix->server_id = $server->id;
        } else {
            $mix->server_id = 0;
        }
        $mix->save();

        $lobby->mix_id = $mix->id;
        $lobby->state = 2;
        $lobby->save();

        if (Cache::has("Timer" . $lobby->id)) {
            Cache::forget("Timer" . $lobby->id);
        }

        $players_array = [];
        foreach ($players as $key => $player) {
            $players_array[] = ['user_id' => $player->user_id, 'mix_id' => $mix->id, 'team' => $player->team, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
        }
        MixPlayer::insert($players_array);

        $mix->startGame();
        $users_array = [];
        foreach ($players as $key => $player) {
            $users_array[] = $player->user_id;
        }
        User::whereIn("id", $users_array)->update(['state' => 2, 'current_game_id' => $mix->id]);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
