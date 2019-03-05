<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterBill extends Model
{
       // バリデーション
       protected $guarded = array('id');
       public static $rules = array (
       /*    'year_month' => 'required',
           'room_id' => 'integer',
           'meterage' => 'nullable|integer',
           'meterage_image' => 'nullable|string',
           'water_usage' => 'nullable|integer',
           'wate_rate' => 'nullable|integer',  */
       );
       // リレーション
       public function room() {
           return $this->belongsTo('App\Room');  // → hasOne, hasMany など
       }
}
