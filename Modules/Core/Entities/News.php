<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Cache;

class News extends Model
{
    //
	//protected $with = ['user'];

  public static function getNotification()
  {
      if (!Cache::has("topnew")) {
          $notification = self::first();
          if (strlen($notification->text) > 420) {
              $notification->text = substr($notification->text, 0, 417) . "...";
          }
          Cache::put("topnew", $notification, 5);
      } else {
        $notification = Cache::get("topnew");
      }
      return $notification;
  }

    public function user()
    {
        return $this->hasOne('Modules\User\Entities\User', 'id', 'published_by');
    }
}
