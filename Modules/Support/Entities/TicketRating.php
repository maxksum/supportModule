<?php

namespace Modules\Support\Entities;

use Illuminate\Database\Eloquent\Model;

class TicketRating extends Model
{
    protected $fillable = [];

    private $options = [
      1 => 'Оценка качества ответа от администрации',
      2 => 'Оценка скорости ответа от администрации',
    ];
}
