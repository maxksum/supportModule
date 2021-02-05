<?php

namespace Modules\Mix\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Modules\User\Entities\User;
use Modules\Mix\Entities\Lobby;
use Modules\Mix\Entities\LobbyPlayer;

class LobbyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $params = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->params['error'] == true) {
            $user = User::find($this->params['user_id']);
            $user->notify($this->params['message']);
        } else {
            switch ($this->params['type']) {
          case 1:
            $user = User::find($this->params['creator_id']);
            if (in_array($user->state, [1, 2])) {
                return $user->notify('Вы уже находитесь в игре');
            }
			
			

            $lobby = new Lobby();
            $lobby->team1name = $this->params['team1name'];
            $lobby->team2name = $this->params['team2name'];
            $lobby->creator_id = $this->params['creator_id'];
            $lobby->per_team = $this->params['per_team'];
            $lobby->map_id = $this->params['map_id'];
            $lobby->password = $this->params['password'];
            $lobby->location_id = $this->params['location_id'];
            $lobby->eac = $this->params['eac'];
            $lobby->players_hidden = $this->params['players_hidden'];
            $lobby->bet = $this->params['bet'];
            $lobby->auto_balance = $this->params['auto_balance'];
            $lobby->skill_from = $this->params['skill_from'];
            $lobby->skill_to = $this->params['skill_to'];
            $lobby->save();
			try {
				$player = new LobbyPlayer();
				$player->user_id = $this->params['creator_id'];
				$player->lobby_id = $lobby->id;
				$player->team = 1;
				$player->bet = $this->params['bet'];
				$player->save();
			}
			catch (\Exception $e) {
				$lobby->delete();
				return;
			}
            

            $user->state = 1;
            $user->current_game_id = $lobby->id;
          //  $user->create_form = serialize($request->except(['password']));
            $user->save();
            break;
          case 2:
            $user = $this->params['user'];
            $lobby = $this->params['lobby'];
            $team = $this->params['team'];
            $player = new LobbyPlayer();
            $player->user_id = $user->id;
            $player->lobby_id = $lobby->id;
            $player->team = $team;
            $player->ready = 0;
            $player->bet = $lobby->bet;
            $player->save();

            $user->state = 1;
            $user->current_game_id = $lobby->id;
            $user->save();

            if ($lobby->players_hidden == 0) {
                $name = $user->name;
            } else {
                $name = "?????";
            }

            $lobby->message("Игрок " . $name . " присоединился к комнате");
            break;
        }
        }
    }
}
