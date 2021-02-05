<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class StatsCsgo extends Model
{
    protected $table = "statistics_csgo";

    //

    private $ranks = [
    1 => [100, 300],
    2 => [300, 500],
    3 => [500, 800],
    4 => [800, 1100],
    5 => [1100, 1500],
    6 => [1500, 1900],
    7 => [1900, 2400],
    8 => [2400, 2900],
    9 => [2900, 3400],
    10 => [3400, 4100],
    11 => [4100, 4800],
    12 => [4800, 5500],
    13 => [5500, 6400],
    14 => [6400, 7300],
    15 => [7300, 8300],
    16 => [8300, 9300],
    17 => [9300, 10600],
    18 => [10600, 12200],
    19 => [12200, 14200],
    20 => [14200, 16700],
    21 => [16700, 18000],
    ];

    private $ranks_names = [
    1 => "LS",
    2 => "LS",
    3 => "LS",
    4 => "MS",
    5 => "MS",
    6 => "MS",
    7 => "AS",
    8 => "AS",
    9 => "AS",
    10 => "HS",
    11 => "HS",
    12 => "HS",
    13 => "SS",
    14 => "SS",
    15 => "SS",
    16 => "PS",
    17 => "PS",
    18 => "PS",
    19 => "OP",
    20 => "OP",
    21 => "OP"
    ];

    private $ranks_full = [
    "LS" => "Low Skill",
    "MS" => "Medium Skill",
    "AS" => "Amateur Skill",
    "HS" => "High Skill",
    "SS" => "Semi-pro Skill",
    "PS" => "Pro skill",
    "OP" => "OverPRO"
    ];

    public $rank_name;

    public function setRankNames() {
        if ($this->exp) {
            $this->own_rank = $this->ranks_names[$this->getRank($this->exp)];
        } else {
            $this->own_rank = "MS";
        }
        $this->own_rank_full = $this->ranks_full[$this->own_rank];
        return;
    }

    public function getExpAttribute($exp)
    {
        return $exp;
    }

    public function getRank($exp = 0)
    {
        if ($exp == 0) {
            $exp = $this->exp;
        }
        foreach ($this->ranks as $key => $rank) {
            if ($exp >= $rank[0] && $exp < $rank[1]) {
                return $key;
            }
        }
    }

    public function getLobbyRank() {
      $rank = $this->ranks_names[$this->getRank($this->exp)];
      switch ($rank) {
        case "LS":
        $res = 1;
        break;
        case "MS":
        $res = 2;
        break;
        case "AS":
        $res = 3;
        break;
        case "HS":
        $res = 4;
        break;
        case "SS":
        $res = 5;
        break;
        case "PS":
        $res = 6;
        break;
        case "OP":
        $res = 7;
        break;
      }
      return $res;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
