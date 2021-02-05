<?php

namespace Modules\Mix\Events;

use Illuminate\Queue\SerializesModels;

use Cache, Carbon;

use Modules\Mix\Entities\{Mix};
use Modules\User\Entities\{User};

class MixesHandlerEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $mixes = Mix::where("game_status", 1)->get();
        foreach ($mixes as $mix) {
            $mix->getServer();
            $mix->getMap();
            if ($mix->server) {
                if ($mix->game_status == 1) {

                    $messenger = $mix->checkServer();
                    if (!$messenger) {
                        $mix->resetGame("Сервер перестал отвечать на запросы.");
                    }

                    $mix->getPlayers();

                    foreach ($mix->players as $player) {
                        if ($player->leaved == 1 && $player->banned == 0) {
                            $user = User::find($player->user_id);

                            $leave_time = $player->getLeaveTime();

                            $nick = preg_replace("/[^a-zA-Zа-яА-Я0-9]+/", "", $user->name);

                            $nick = addslashes($nick);

                            if ($leave_time == 300) {
                                $player->banned = 1;
                                $user->banned_until = Carbon::now()->addMinutes(10);
                                $user->state = -1;
                                $user->ban_reason = "Выход из игры №" . $mix->id;
                                $user->save();
                                $player->save();
                                $messenger->send('say "Игрок ' . $nick . ' заблокирован на 10 минут за выход из игры"');
                                $res = $mix->validateTeams();
                                if ($res == 1) {
                                    $messenger->send('say "Техническая победа для команды Team 1. Игра окончена."');
                                    $mix->changeStatus(2, ["Техническая победа", "Техническое поражение"], $res, "16:0", true, false);
                                    $mix->server->state = 0;
                                    $mix->server->save();
                                } elseif ($res == 2) {
                                    $messenger->send('say "Техническая победа для команды Team 2. Игра окончена."');
                                    $mix->changeStatus(2, ["Техническая победа", "Техническое поражение"], $res, "0:16", true, false);
                                    $mix->server->state = 0;
                                    $mix->server->save();
                                }
                            } else {
                                if ($leave_time % 60 == 0) {
                                    $messenger->send('say "У игрока ' . $nick . ' осталось ' . (300 - $leave_time) . ' секунд чтобы переподключиться"');
                                }
                                if ($leave_time % 30 == 0) {
                                    $messenger->send('say "Для паузы игры напишите !pause в чат."');
                                }
                            }
                            Cache::put($mix->id . "leave" . $player->user_id, $leave_time, 60);
                        }
                    }
                }
            } else {
                $mix->changeStatus(-1, "Технические неполадки на сервере(сервер не найден)");
            }
        }
    }
}
