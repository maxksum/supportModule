<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Module, Config;

class Operation extends Model
{
    private $operations = [
        0    =>  'Пополнение счета',
        1    =>  'Присоединение к игре',
        2    =>  'Победа в игре',
        3    =>  'Отмена игры',
        4    =>  'Взнос предметов',
        5    =>  'Вывод предметов завершен',
        6    =>  'Отмена вывода предметов',
        7    =>  'Изменение CSDM',
        8    =>  'Бонус за вступление в группу VK',
        9    =>  'ТОП акции Deathmatch',
        10   => 'Изменение администратором',
        11   => 'Массовое начисление',
        12  => 'Акция - домен в никнейме',
        13  => 'Вывод из реферальной системы',
        14  => 'Бонус за приход от реферера',
        15  => 'Проигрыш в игре',
        16  => 'Пополнение intellectmoney',
        17  => 'Бонус за первое пополнение',
        18  => 'Бонус за игру',
        19  => 'Оформление заявки на вывод',
        20  => 'Отказ в выводе',
        21  => 'Возврат заявки на вывод',
        22  => 'Отмена заявки пользователем',
    ];

    protected $table = "operations";
    //



    public function getOperationCodeAttribute($id) {
        $modules = Module::toCollection();
        foreach ($modules as $module) {
           if (Config::get($module->getLowerName() . ".product_id") == $this->product_code) {
             $operations = Config::get($module->getLowerName() . ".operations");
             return $operations[$id];
           }
        }
        return "";
    }

    public function dm_server() {
        return $this->belongsTo('Modules\Deathmatch\Entities\DmServer', 'csdm_id');
    }

    public function mix() {
        return $this->belongsTo('Modules\Mix\Entities\Mix', 'mix_id');
    }

    public function user() {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }
}
