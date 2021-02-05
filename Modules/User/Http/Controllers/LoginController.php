<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Http\Requests;

use kanalumaddela\LaravelSteamLogin\SteamLogin;

use Modules\User\Entities\{User};
use Modules\Referral\Entities\{Referral};

use Auth;
use Redirect;
use Config;

class LoginController extends Controller
{
    protected $steam;

    protected $request;

    public function __construct(Request $request, SteamLogin $steam)
    {
        $this->request = $request;
        $this->steam = $steam;
    }

    public function login()
    {
        if (!Auth::check()) {
            return $this->steam->redirect();
        } else {
            return Redirect::intended('/');
        }
    }

    public function handle()
    {
        if ($this->steam->validate()) {
            $info = $this->steam->getPlayerInfo();
            if ($info->avatarSmall == "") {
              return Redirect::intended('/');
            }

            $user = $this->findOrNewUser($info);

            Auth::login($user, true);
        }

        return $this->steam->return();
    }

    protected function findOrNewUser($info)
    {
        if (session("ref")) {
            $ref = session("ref");
        } else {
            $ref = null;
        }

        $user = User::where('steamid', $info->steamid2)->first();

        $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];
        $country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? strtolower($_SERVER['HTTP_CF_IPCOUNTRY']) : "ru";

        if (is_null($user)) {
            $user = User::create([
              'nick' => $info->realName,
              'name' => (empty($info->name) ? $info->realName : $info->name),
              'avatar' => $info->avatarSmall,
              'avatar_medium' => $info->avatarMedium,
              'avatar_full' => $info->avatarLarge,
              'steamid' => $info->steamid2,
              'steamid64' => $info->steamid,
              'password' => bcrypt($info->steamid),
              'profile' => "https://steamcommunity.com/profiles/" . $info->steamid . "/",
              'money' => 100 * Config::get("core.money_multiplier"),
              'referrer_id' => $ref,
              'register_ip' => $ip,
              'last_ip' => $ip,
              'last_country' => $country,
          ]);

            if ($ref && $user) {
                $referral = new Referral();
                $referral->user_id = $user->id;
                $referral->referrer_id = $ref;
                $referral->profit = 0;
                $referral->save();
            }
        } else {
            $user->nick = $info->realName;
            $user->name = (empty($info->name) ? $info->realName : $info->name);
            $user->avatar = $info->avatarSmall;
            $user->avatar_medium = $info->avatarMedium;
            $user->avatar_full = $info->avatarLarge;
            $user->last_ip = $ip;
            $user->last_country = $country;
            $user->save();
        }

        return $user;
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::intended('/');
    }
}
