<?php

namespace App\model\set_meet_room;

use Illuminate\Database\Eloquent\Model;

class meet_room extends Model
{
    protected $table = 'pk_meet_room';

    protected $fillable = [
    'code_room','name_room','image_room','image_file','type_id','active','created_by','update_by'
    ];

    public function scopeGetMeet_room($query){
        return $query;
    }
    public function scopeMeet_Room_Active($query){
        return $query->where('active',1);
    }


    //relate
    public function type_room(){
        return $this->belongsTo('App\model\set_meet_room\type_room','type_id');
    }

    public function reservation_details(){
        return $this->hasMany('App\model\reserve_room\reservation_details');
    }
}
