<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    // バリデーション
    protected $guarded = array('id');

    public static $rules = array (
        'name' => 'required',
        'room_id' => 'integer',
        'entrance_date' => 'date',
        'exit_date' => 'nullable|date',
        'tel' => 'nullable|regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',
        'mail' => 'nullable|email',
    );

    // リレーション
    public function room() {
        return $this->belongsTo('App\Room');
    }



}
