<?php

namespace Modules\Mix\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Mix\Entities\MixServerLocation;
use Modules\Core\Entities\Map;
use Config;

class MixDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Product::insert([
          "id" => Config::get("mix.product_id"),
          "name" => "Mix",
          "money" => 0,
        ]);
		
		MixServerLocation::insert([
          'name' => 'Location #' . rand(1, 10),
          'demo_host' => 'host.ru',
          'active' => rand(0, 1),
        ]);
		
		Map::insert([
        	"name" => "de_dust2",
    		"file" => "de_dust2.rar",
    		"image" => "2.jpg",
    		"type" => "CW",
    		"short_name" => "dust2",
    		"active" => "1",
    		"sort" => "0",
        ]);
        Map::insert([
        	"name" => "de_inferno",
    		"file" => "de_inferno.rar",
    		"image" => "12.jpg",
    		"type" => "CW",
    		"short_name" => "inferno",
    		"active" => "1",
    		"sort" => "1",
        ]);
    }
}
