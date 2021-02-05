<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Mix\Entities\{KarmaVote};
use Modules\User\Entities\{User};
use Cache;

class MixPlayer extends Model
{
    public function setKarma()
    {
        if (!Cache::has("karma" . $this->mix_id . "_" . $this->user_id)) {
            $this->karma = KarmaVote::where([["mix_id", $this->mix_id], ['target_id', $this->user_id]])->sum("value");
            Cache::put("karma" . $this->mix_id . "_" . $this->user_id, $this->karma, 1);
        } else {
          $this->karma = Cache::get("karma" . $this->mix_id . "_" . $this->user_id);
        }
    }

    public function getLeaveTime()
    {
        if (Cache::has($this->mix_id . "leave" . $this->user_id)) {
            $leave_time = Cache::get($this->mix_id . "leave" . $this->user_id);
        } else {
            $leave_time = 0;
        }
        $leave_time += 5;
        return $leave_time;
    }

    public function setUser() {
      $this->user = (object)User::getUser($this->user_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
