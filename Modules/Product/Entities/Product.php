<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Product extends Model
{
    //

    public static function getAll() {
      if (!Cache::has("Products")) {
          $products = self::all();
          Cache::put("Products", $products, 5);
      } else {
          $products = Cache::get("Products");
      }
      return $products;
    }
}
