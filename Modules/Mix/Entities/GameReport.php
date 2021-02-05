<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;

class GameReport extends Model
{
    //
     public function user(){
        return $this->belongsTo('Modules\User\Entities\User');
    }

     public function report_user(){
        return $this->belongsTo('Modules\User\Entities\User', 'report_id');
    }
}
