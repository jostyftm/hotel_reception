<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    protected $fillable = [
    	'room_id', 'src'
    ];

    public function room()
    {
    	return $this->belongsTo(Room::class, 'room_id');
    }
}
