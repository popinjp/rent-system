<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterRate extends Model
{
       // バリデーション
       protected $guarded = array('id');
       public static $rules = array (
           'year_month' => 'required',
           'water_rate_url' => 'required|url',
           'water_rate_data' => 'nullable',
       );
}
