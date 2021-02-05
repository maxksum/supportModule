<?php

namespace Modules\Mix\Entities;

use Illuminate\Database\Eloquent\Model;
use Cache;
use Modules\Mix\Entities\{MixServer};

class MixServerLocation extends Model
{
  
    public static function getAll() {
      if (!Cache::has("MixLocations")) {
          $locations = self::where('active', 1)->orderBy("sort")->get();
          $location_ids = $locations->pluck(['id']);
          $allservers = MixServer::whereIn("location_id", $location_ids)->get();
          foreach ($locations as &$location) {
              $location['servers'] = $allservers->where('location_id', $location->id)->count();
              $location['freeservers'] = $allservers->where('location_id', $location->id)->where('state', 0)->count();
          }
          Cache::put("MixLocations", $locations, 5);
      } else {
        $locations = Cache::get("MixLocations");
      }
      return $locations;
    }

}
