<?php

namespace Modules\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Modules\User\Events\{UserNotifyEvent};
use Modules\User\Entities\{StatsCsgo};
use Modules\User\Jobs\{ChangeBalance};
use Modules\Mix\Entities\Lobby;
use Modules\Mix\Entities\Mix;
use Carbon;
use Log;
use Auth;
use Cache;

class User extends Authenticatable
{
    //use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $with = ['csgo'];

    protected $fillable = [
    'nick', 'name', 'avatar', 'avatar_medium', 'avatar_full', 'steamid', 'steamid64', 'profile', 'password', 'money'
    ];


    private $roles = [
    1 => 'user',
    2 => 'moderator',
    3 => 'administrator',
    ];

    public static function getUser($id)
    {
        if (!Cache::has("Userdata" . $id)) {
            $user_model = self::find($id);
            if ($user_model) {
                $user_model->initStats();
                $user_model = [ 'id'=> $user_model->id, 'kills' => $user_model->csgo->kills, 'deaths' => $user_model->csgo->deaths, 'headshot_kills' => $user_model->csgo->headshot_kills, 'games' => $user_model->csgo->games, 'wins' => $user_model->csgo->wins, 'name' => $user_model->name, 'avatar_medium' => $user_model->avatar_medium,'avatar_full' => $user_model->avatar_full, 'own_rank' => $user_model->csgo->own_rank, 'own_rank_full' => $user_model->csgo->own_rank_full, 'steamid'=> $user_model->steamid, 'steamid64'=>$user_model->steamid64, 'role' => $user_model->role, 'twitch_channel' => $user_model->twitch_channel, 'trade_link' => $user_model->trade_link, 'exp' => $user_model->csgo->exp];
                Cache::put("Userdata" . $id, $user_model, 5);
            }
        } else {
            $user_model = Cache::get("Userdata" . $id);
        }
        return $user_model;
    }

    public static function getUserExp($id)
    {
        if (!Cache::has("UserExp" . $id)) {
            $user = User::find($id);
            $user->initStats();
            $exp = $user->csgo->exp;
            Cache::put("UserExp" . $id, $exp, 5);
        } else {
            $exp = Cache::get("UserExp" . $id);
        }
        return $exp;
    }

    public static function getUseridBySteam($steam)
    {
        if (!Cache::has("UseridBySteam_" . $steam)) {
            $user = self::where('steamid', $steam)->first();
            $id = $user->id;
            Cache::put("UseridBySteam_" . $steam, $id, 30);
        } else {
            $id = Cache::get("UseridBySteam_" . $steam);
        }
        return $id;
    }

    public static function getUseridBySteam64($steam)
    {
        if (!Cache::has("UseridBySteam64_" . $steam)) {
            $user = self::where('steamid64', $steam)->first();
            $id = $user->id;
            Cache::put("UseridBySteam64_" . $steam, $id, 30);
        } else {
            $id = Cache::get("UseridBySteam64_" . $steam);
        }
        return $id;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function csgo()
    {
        return $this->hasOne('Modules\User\Entities\StatsCsgo', 'user_id');
    }

    public function initStats()
    {
        if (!$this->csgo) {
            $stats = new StatsCsgo();
            $stats->user_id = $this->id;
            $stats->save();
            $this->csgo = $stats;
        }
        $this->csgo->setRankNames();
    }

    public function scores()
    {
        return $this->hasOne('Modules\Deathmatch\Entities\DmUserScore', 'user_id');
    }

    public function payments()
    {
        return $this->hasMany('Modules\Payment\Entities\Payment');
    }

    public function getRoleAttribute($id)
    {
        return $this->roles[$id];
    }

    public function lastMix()
    {
        $player = MixPlayer::where("user_id", $this->id)->orderBy("id", "desc")->first();
        if ($player) {
            $this->last_mix = Mix::find($player->mix_id);
        }
    }

    public function notify($message)
    {
        event(new UserNotifyEvent($this->id, $message));
    }

    public static function getMy()
    {
        if (Auth::check()) {
            $my = Auth::user();
            $my->initStats();

            if (in_array($my->state, [1, 2])) {
                if ($my->state == 1) {
                    $lobby = Lobby::find($my->current_game_id);
                } else {
                    $mix = Mix::find($my->current_game_id);
                    $lobby = Lobby::find($mix->lobby_id);
                }
                if ($lobby) {
                    $lobby->validate();
                    $my->lobby = $lobby;
                }
            }
            return $my;
        } else {
            return null;
        }
    }

    public function refreshOnline()
    {
        if (Cache::has("UsersOnline")) {
            $online = Cache::get("UsersOnline");
        } else {
            $online = [];
        }
        $online[$this->id] = (object)["user" => $this, "expire_at" => Carbon::now()->addMinutes(10)];
        Cache::forever("UsersOnline", $online);
    }

    public function isOnline()
    {
        if (Cache::has("UsersOnline")) {
            $online = Cache::get("UsersOnline");
            if (isset($online[$this->id])) {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function getOnline()
    {
        if (Cache::has("UsersOnline")) {
            if (!Cache::has("OnlineUsersFull")) {
                $users = Cache::get("UsersOnline");
                $online = [];
                foreach ($users as &$user) {
                    $online_temp = $user->user;
                    $online_temp->initStats();
                    if ($online_temp->state == 1) {
                        $online_temp->lobby_id = $online_temp->current_game_id;
                    } elseif ($online_temp->state == 2) {
                        $mix = Mix::find($online_temp->current_game_id);
                        if ($mix) {
                            $online_temp->lobby_id = $mix->lobby_id;
                        }
                    }
                    $online[] = $online_temp;
                }
                $users = array_values($online);
                Cache::put("OnlineUsersFull", $users, 1);
            } else {
                $users = Cache::get("OnlineUsersFull");
            }
        } else {
            $users = [];
        }
        return $users;
    }

    public static function changeBalance($user, $product, $user_sum, $product_sum, $operation_code, $comment = "", $callback = false, $params = [])
    {
        Log::info("New operation: USER " . $user . " PRODUCT " . $product . " SUM " . $user_sum . " PRODUCT_SUM " . $product_sum . " OPERATION " . $operation_code . " COMMENT '" . $comment . "'");

        if ($callback !== false) {
            ChangeBalance::withChain([
        new $callback(array_merge($params, ['error' => false]))
        ])->dispatch($user, $product, $user_sum, $product_sum, $operation_code, $comment, $callback, $params)->allOnQueue('financial');
        } else {
            ChangeBalance::dispatch($user, $product, $user_sum, $product_sum, $operation_code, $comment, $params);
        }
    }
}
