<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Mix\Entities\{MixServerGroup};
use Cache;

class MixServer extends Model
{
    protected $table = 'mix_servers';

    public function getServerGroup()
    {
        if (!Cache::has("servergroup" . $this->server_group_id)) {
            $group = MixServerGroup::find($this->server_group_id);
            Cache::put("servergroup" . $this->server_group_id, $group, 5);
        } else {
            $group = Cache::get("servergroup" . $this->server_group_id);
        }
        $this->group = $group;
    }
}
