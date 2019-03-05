<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = array('id');

    public static $rules = array (
        'name' => 'required',
    );

    // Resident 結合 
    public function resident() {
        return $this->hasOne('App\Resident');
    }

}
