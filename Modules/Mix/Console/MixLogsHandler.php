<?php

namespace Modules\Mix\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use DB;

use Modules\Mix\Entities\{MixServer, Mix, MixPlayer};
use Modules\User\Entities\{User};

class MixLogsHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mixlogs:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daemon for mix handling';


    private $server;
    private $peer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $socket = stream_socket_server("udp://0.0.0.0:7001", $errno, $errstr, STREAM_SERVER_BIND);
        if (!$socket) {
            die("$errstr ($errno)");
        }

        do {
            $pkt = stream_socket_recvfrom($socket, 512, 0, $peer);
            $this->peer = $peer;
            $this->set_server($peer);
            $this->parse($pkt);
            stream_socket_sendto($socket, date("D M j H:i:s Y\r\n"), 0, $peer);
        } while ($pkt !== false);
        return;
    }

    private function set_server($address)
    {
        $server = MixServer::where('address', $address)->first();
        if (!$server) return false;
        $this->server = $server;
        return false;
    }

    private function parse($data)
    {

        if (strstr($data, " entered") !== FALSE) {
            $this->connect($data);
        }

        if (strstr($data, " disconnected") !== FALSE) {
            $this->disconnect($data);
        }

        if (strstr($data, " suicide") !== FALSE) {
            $this->suicide($data);
        }

        if (strstr($data, '"event": "player_death"') !== FALSE) {
            $this->death($data);
        }

        if (strstr($data, '"event": "bomb_planted"') !== FALSE) {
            $this->bomb_planted($data);
        }

        if (strstr($data, '"event": "bomb_defused"') !== FALSE) {
            $this->bomb_defused($data);
        }

        if (strstr($data, '"event": "match_config_load_fail"') !== FALSE) {
            $this->load_failed($data);
        }

        if (strstr($data, '"event": "knife_start"') !== FALSE) {
            $this->knife_start($data);
        }

        if (strstr($data, '"event": "going_live"') !== FALSE) {
            $this->going_live($data);
        }

        if (strstr($data, '"event": "map_end"') !== FALSE) {
            $this->map_end($data);
        }

        if (strstr($data, '"event": "series_start"') !== FALSE) {
            $this->series_start($data);
        }

        if (strstr($data, '"event": "series_end"') !== FALSE) {
            $this->series_end($data);
        }


        if (strstr($data, '"event": "client_say"') !== FALSE) {
            $this->client_say($data);
        }

        return;
    }

    private function load_failed($data) {
        $data = trim($data);
        $start = strpos($data, "{");
        $length = strripos($data, "}") - $start + 1;
        $json = json_decode(substr($data, $start, $length));
        $mixid = DB::select(DB::raw("SELECT mixes.id as res FROM mixes LEFT JOIN mix_servers ON mix_servers.id = mixes.server_id WHERE mix_servers.address = '" . $this->server->address . "' AND game_status = 0"));
        if (sizeof($mixid) > 0) {
          $mixid = $mixid[0]->res;
        } else {
          return;
        }
        $mix = Mix::find($mixid);
        if (!$mix) {
            Log::info(date('Y-m-d h:i:s') . ": Ошибка конфигурации на сервере" . $this->server->address . " с ошибкой: " . $json->params->reason);
            return;
        }
        $this->server->state = 0;
		$this->server->save();
		$mix->changeStatus(-1, "Ошибка конфигурации матча: " . $json->params->reason, null, null, false, false);
    }

    private function going_live($data)
    {
    }

    private function knife_start($data)
    {
    }

    private function map_end($data)
    {
    }

    private function series_start($data)
    {

    }

    private function series_end($data)
    {
    }

    private function suicide($data)
    {
        preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $data, $matches);
        if (isset($matches[2][0])) {
            $user = User::getUseridBySteam("STEAM_0" . $matches[2][0]);
        } else {
            return;
        }

        if ($user) {
            $player = MixPlayer::where("user_id", $user)->orderBy("id", "desc")->first();
            $mix = Mix::find($player->mix_id)->orderBy("id", "desc")->first();
            if ($mix->game_status == 1 && $mix->per_team != 1) {
                $player->exp_ratio -= 5;
                $player->save();
            }
        }

        return;
    }

    private function death($data)
    {
        $data = trim($data);
        $start = strpos($data, "{");
        $length = strripos($data, "}") - $start + 1;
        $json = json_decode(substr($data, $start, $length));


        preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $json->params->attacker, $player);
        if (isset($player[2][0])) {
            $killer["steam"] = "STEAM_0" . $player[2][0];
        } else {
            return;
        }
        preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $json->params->victim, $player);
        if (isset($player[2][0])) {
            $victim["steam"] = "STEAM_0" . $player[2][0];
        } else {
            return;
        }


        $killer = User::getUseridBySteam($killer["steam"]);

        $victim = User::getUseridBySteam($victim["steam"]);

        $player = User::find($victim);
        if (!$player) {
           $player = User::find($killer);
           if (!$player) {
             return "bad";
         }
     }
     $mix = Mix::find($json->matchid); //cache

     if (!$mix) {
        $this->info("bad mix");
        return;
    }

    if ($mix->game_status == 1 && $mix->per_team != 1) {
        if ($killer && $victim) {
            $killer_exp = User::getUserExp($killer);
            $killer_pl = MixPlayer::where("user_id", $killer)->orderBy("id", "desc")->first();
            $victim_exp = User::getUserExp($victim);
            $victim_pl = MixPlayer::where("user_id", $victim)->orderBy("id", "desc")->first();

            $default_exp = 5;
            $exp_ratio = $killer_exp / $victim_exp;
            $result = $default_exp / $exp_ratio;
            $killer_pl->exp_ratio += $result;
            $killer_pl->save();
            $victim_pl->exp_ratio -= $result;
            $victim_pl->save();
        }
    }

    return;
}

private function connect($data)
{
    preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $data, $matches);
    if (isset($matches[2][0])) {
        $user = User::where('steamid', "STEAM_0" . $matches[2][0])->first();
    } else {
        $this->info("Cant parse connect: " . $data);
        return;
    }
    if ($user) {
        $mix_player = MixPlayer::where("user_id", $user->id)->orderBy("id", "desc")->first();
        if ($mix_player) {
            $mix = Mix::find($mix_player->mix_id);
            if ($mix) {
                $mix_player->entered = 1;
                $mix_player->leaved = 0;
                $mix_player->save();
            }
        }
    }
    return;
}

private function disconnect($data)
{
    preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $data, $matches);
    if (isset($matches[2][0])) {
        $user = User::where('steamid', "STEAM_0" . $matches[2][0])->first();
    } else {
        if (strpos($data, "<BOT>") === false) {
            Log::info("Cant parse disconnect: " . $data);
        }
        return;
    }

    if ($user) {
        $mix_player = MixPlayer::where("user_id", $user->id)->orderBy("id", "desc")->first();
        if ($mix_player) {
            $mix = Mix::find($mix_player->mix_id);
            if ($mix) {
                $mix_player->leaved = 1;
                if ($mix->game_status == 0) {
                    $mix_player->entered = 0;
                }
                $mix_player->save();
            }
        }
    }
    return;
}

private function bomb_planted($data)
{
    $data = trim($data);
    $start = strpos($data, "{");
    $length = strripos($data, "}") - $start + 1;
    $json = json_decode(substr($data, $start, $length));

    preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $json->params->client, $player);
    if (isset($player[2][0])) {
        $client = "STEAM_0" . $player[2][0];
    } else {
        return;
    }

    $client = User::getUseridBySteam($client);
    $player = MixPlayer::where("user_id", $client)->orderBy("id", "desc")->first();
    $mix = Mix::find($player->mix_id)->orderBy("id", "desc")->first();

    if ($mix->game_status == 1 && $mix->per_team != 1) {
        if ($client) {
            $client_pl = MixPlayer::where("user_id", $client)->orderBy("id", "desc")->first();
            $client_pl->exp_ratio += 5;
            $client_pl->save();
        }
    }
}

private function bomb_defused($data)
{
    $data = trim($data);
    $start = strpos($data, "{");
    $length = strripos($data, "}") - $start + 1;
    $json = json_decode(substr($data, $start, $length));

    preg_match_all('|<([0-9]+)><STEAM_1(.*)>|U', $json->params->client, $player);
    if (isset($player[2][0])) {
        $client = "STEAM_0" . $player[2][0];
    } else {
        return;
    }

    $client = User::getUseridBySteam($client);
    $player = MixPlayer::where("user_id", $client)->orderBy("id", "desc")->first();
    $mix = Mix::find($player->mix_id);

    if ($mix->game_status == 1 && $mix->per_team != 1) {
        if ($client) {
            $client_pl = MixPlayer::where("user_id", $client)->orderBy("id", "desc")->first();
            $client_pl->exp_ratio += 5;
            $client_pl->save();
        }
    }
}

private function client_say($data)
{

}

}
