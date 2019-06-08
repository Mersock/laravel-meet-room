<?php

namespace App\model\reserve_room;

use Illuminate\Database\Eloquent\Model;

class reservation_details extends Model
{
    protected $table = 'pk_reserve_room';

    protected $fillable = [
    'id','title','detail','reserve_date','room_id','approve_status','created_by','updated_by'
    ];

    public function meet_room()
    {
        return $this->belongsTo('App\model\set_meet_room\meet_room','room_id');
    }

    public function time_room_reserve(){
        return $this->hasMany('App\model\reserve_room\time_room_reserve');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    
}
