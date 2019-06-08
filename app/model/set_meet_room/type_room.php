<?php

namespace App\model\set_meet_room;

use Illuminate\Database\Eloquent\Model;

class type_room extends Model
{
    protected $table = 'pk_type_room';
    //relate
    public function meet_room(){
        return $this->hasMany('App\model\set_meet_room\meet_room','type_id');
    }
    //queryscope
    public function scopeGettype_room($query){
        return $query;
    }
    public function scopeType_Room_active($query){
        return $query->where('active',1);
    }

}
