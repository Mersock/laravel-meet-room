<?php

namespace App\model\reserve_room;

use Illuminate\Database\Eloquent\Model;

class time_room_reserve extends Model
{
    protected $table = 'pk_time_reserve_room';

    public $timestamps = false;

    protected $fillable = ['id','reserve_room_id','time_reserve','date_reserve'];

    public function reservation_details(){
        return $this->belongsTo('App\model\reserve_room\reservation_details','reserve_room_id');
    }
    public function scopeGet_Time_Room($query){
        return $query;
    }
}
