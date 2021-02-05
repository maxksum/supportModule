<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Mix\Entities\Lobby;
use Modules\Mix\Entities\Mix;
use Modules\Mix\Entities\MixServer;
use Modules\Mix\Entities\MixServerLocation;
use Modules\Deathmatch\Entities\DmServer;
use Modules\Deathmatch\Entities\DmUserScore;
use Modules\Tournament\Entities\{Tourney};
use Modules\User\Entities\User;
use Modules\User\Entities\StatsCsgo;
use Modules\Core\Entities\Operation;
use Modules\Core\Entities\Map;
use Modules\Core\Entities\News;
use Modules\Referral\Entities\Referral;

use GuzzleHttp\Client as Guzzle;

use Auth;
use Cache;
use DB;
use Carbon\Carbon;
use Module;
use Config;
use JavaScript;

class CoreController extends Controller
{
    public function test()
    {
      Referral::change(1, 300, 1);
    }

    public function loginLocal()
    {
        if (env("APP_ENV") == "local") {
            Auth::loginUsingId(1);
            return redirect("/");
        }
    }

    public function getTops()
    {
        $tops = [];
        if (!Cache::has("headshots_top")) {
            $headshots = StatsCsgo::orderBy("headshot_kills", "desc")->take(10)->get();
            foreach ($headshots as &$headshot) {
                $headshot->user = (object)User::getUser($headshot->user_id);
                $headshot->value = $headshot->headshot_kills;
            }
            Cache::put("headshots_top", $headshots, 5);
        } else {
            $headshots = Cache::get("headshots_top");
        }
        if (!Cache::has("kills_top")) {
            $kills = StatsCsgo::orderBy("kills", "desc")->take(10)->get();
            foreach ($kills as &$kill) {
                $kill->user = (object)User::getUser($kill->user_id);
                $kill->value = $kill->kills;
            }
            Cache::put("kills_top", $kills, 5);
        } else {
            $kills = Cache::get("kills_top");
        }

        if (!Cache::has("elos_top")) {
            $elos = StatsCsgo::orderBy("exp", "desc")->take(10)->get();
            foreach ($elos as &$elo) {
                $elo->user = (object)User::getUser($elo->user_id);
                $elo->value = $elo->exp;
            }
            Cache::put("elos_top", $elos, 5);
        } else {
            $elos = Cache::get("elos_top");
        }

        $tops[] = ['title' => 'ELO', 'players' => $elos];
        $tops[] = ['title' => 'УБИЙСТВАМ', 'players' => $kills];
        $tops[] = ['title' => 'ХЕДШОТАМ', 'players' => $headshots];
        return $tops;
    }

    public function load_data()
    {
        $data = [];
        $data['news'] = News::getNotification();
        $data['streamers'] = [];
        $data['tops'] = $this->getTops();
        $data['maps'] = Map::getAllMaps();
        $data['locations'] = Module::has("Mix") ? MixServerLocation::getAll() : [];
        $data['tourneys'] = Module::has("Tournament") ? Tourney::getAll() : [];
        return $data;
    }

    public function index(Request $request)
    {
        if (!Auth::check() && $request->ref && !$request->session()->has('ref')) {
            if (User::where("id", $request->ref)->exists()) {
                $request->session()->put('ref', $request->ref);
                User::where("id", $request->ref)->increment("referral_conversions");
            }
        }

        $data = $this->load_data();
        if (Auth::check()) {
          $create_form = unserialize(Auth::user()->create_form);
        } else {
          $create_form = [];
        }

        JavaScript::put([
          'maps' => $data['maps'],
          'tourneys' => $data['tourneys'],
          'locations' => $data['locations'],
          'tops' => $data['tops'],
          'create_form' => $create_form,
          'lobby_id' => $request->has("lobby_id") ? $request->lobby_id : 0,
        ]);
        return view('core::home', $data);
    }

    public function dmServers()
    {
        if (Module::has("Deathmatch")) {
            $servers = [];
        } else {
            if (!Cache::has("deathmatch_servers")) {
                $servers = DmServer::where('status', 1)->orderBy("sort", "asc")->get();
                Cache::put("deathmatch_servers", $servers, 10);
            } else {
                $servers = (object)Cache::get("deathmatch_servers");
            }
        }
        return $servers;
    }

    public function getCounts()
    {
        if (!Module::has("Mix")) {
            return [
                'total_mixes' => 0,
                'mixes_today' => 0,
                'mixes_playing' => 0,
                'mixes_progress' => 0,
                'playing_now' => 0,
                'users_online' => 0,
            ];
        }
        if (!Cache::has("MainCounts")) {
            $counts = [];
            $counts['total_mixes'] = DB::select(DB::raw("SELECT COUNT(*) as res FROM mixes WHERE game_status IN (0, 1, 2)"))[0]->res;
            $counts['mixes_today'] = DB::select(DB::raw("SELECT COUNT(*) as res FROM mixes WHERE created_at > (now() - interval 1 day)"))[0]->res;
            $counts['mixes_playing'] = DB::select(DB::raw("SELECT COUNT(*) as res FROM mixes WHERE game_status IN (0, 1)"))[0]->res;
            $counts['mixes_progress'] = DB::select(DB::raw("SELECT COUNT(*) as res FROM lobbies WHERE state IN (0, 1)"))[0]->res;
            $counts['playing_now'] = DB::select(DB::raw("SELECT SUM(per_team * 2) as res FROM mixes WHERE game_status IN (0, 1)"))[0]->res;
            if ($counts['playing_now'] == null) {
                $counts['playing_now'] = 0;
            }
            $counts['users_online'] = User::getOnline();
            Cache::put("MainCounts", $counts, 1);
        } else {
            $counts = Cache::get("MainCounts");
        }
        return $counts;
    }

    public function showUserReport()
    {
        $ops = Operation::where('user_id', Auth::user()->id)->orderBy("id", "desc")->paginate(15);
        JavaScript::put([
          "ops" => $ops
        ]);
        return view('core::report');
    }
}
