<?php

namespace App\model\set_meet_room;

use Illuminate\Database\Eloquent\Model;

class set_time extends Model
{
    protected $table = 'pk_time_reserve';

    protected $fillable = [
    'time_hour','created_by','updated_by'
    ];

    public function scopeGet_Time($query){
        return $query;
    }
}
