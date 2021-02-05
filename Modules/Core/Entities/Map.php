<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Map extends Model
{
  public static function getMap($id) {
		if (!Cache::has("Map" . $id)) {
			$map = self::find($id);
			$map->image = "/img/maps/" . $map->image;
			Cache::put("Map" . $id, $map, 30);
		} else {
			$map = Cache::get("Map" . $id);
		}
		return $map;
	}

	public static function getAllMaps() {
		if (!Cache::has("all_maps")) {
			$maps = self::where("active", 1)->orderBy("sort", "asc")->get();
			foreach ($maps as &$map) {
				$map->image = "/img/maps/" . $map->image;
			}
			Cache::put("all_maps", $maps, 10);
		} else {
			$maps = Cache::get("all_maps");
		}
		return $maps;
	}
}
