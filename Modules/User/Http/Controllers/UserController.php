<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Http\Requests;

use Modules\User\Entities\{User};
use Modules\Mix\Entities\Mix;
use Modules\Mix\Entities\MixPlayer;

use Cache;
use Auth;
use DB;
use JavaScript;

class UserController extends Controller
{
    public function show($id = 0, Request $request)
    {
        if ($id == 0) {
            if (!Auth::check()) {
                return redirect()->to("/");
            } else {
                return redirect()->to("/user/" . Auth::user()->id);
            }
        } else {
            $user = User::find($id);
            if (!$user) {
                return redirect()->to("/user/");
            } else {
                $user->csgo->setRankNames();
            }
        }
        $page = $request->page;

        if (!class_exists('\Modules\Mix\Entities\Mix') && !class_exists('\Modules\Mix\Entities\MixPlayer')) {
            $user->online = 'off';
            $data['last10'] = [];
            $data['pagination'] = [];
            $data['user'] = $user;
        } else {
            if (!Cache::has("UserStatsProfile" . $user->id . "_" . $page)) {
                $last_paginate = MixPlayer::where("user_id", $user->id)->orderBy("id", "desc")->paginate(10);
                $last = [];
                $winner = [];
                foreach ($last_paginate as $game) {
                    $last[] = $game->mix_id;
                    $winner[$game->mix_id] = $game->winner;
                }
                $last10 = Mix::whereIn("id", $last)->orderBy("id", "desc")->get();
                foreach ($last10 as $key=>&$game) {
                    $game->getServer();
                    $game->getCreator();
                    $game->getPlayers();
                    $game->getMap();
                    $game->winner = $winner[$game->id];
                    foreach ($game->players as $key=>$player) {
                        $game->players[$key]->setUser();
                        $game->players[$key]->setKarma();
                    }
                }
                $data['last10'] = $last10;
                $data['pagination'] = $last_paginate;
                $user->online = $user->isOnline() ? 'on' : 'off';
                $data['user'] = $user;
                Cache::put("UserStatsProfile" . $user->id . "_" . $page, $data, 1);
            } else {
                $data = Cache::get("UserStatsProfile" . $user->id . "_" . $page);
            }
        }
        $country = strtolower($user->last_country);
        $data['country'] = $country;


        JavaScript::put([
          'user_src' => $data['user'],
          'pagination' => $data['pagination'],
          'country' => $data['country'],
          'city' => "",
          'last' => $data['last10'],
        ]);

        return view("user::profile", $data);
    }

    public function editTrade(Request $request)
    {
        $user = Auth::user();
        $new_link = trim($request->tradelink);
        $pattern = "/^http[s]*:\/\/steamcommunity.com\/tradeoffer\/new\/\?partner=([0-9]+)&token=([-a-zA-Z0-9_]+)$/";
        if (preg_match($pattern, $new_link)) {
            $user->trade_link = $new_link;
            $user->save();
            return ["error" => false, "message" => "Ссылка успешно изменена"];
        } else {
            return ["error" => true, "message" => "Введенная ссылка не валидна"];
        }
    }

    public function editAbout(Request $request)
    {
        $user = Auth::user();
        $about = $request->about;
        $user->about = $about;
        $user->save();
        Cache::forget("UserStatsProfile" . $user->id . "_");
        return ['error' => false];
    }

    public function reports()
    {
        return view("user::reports");
    }
}
