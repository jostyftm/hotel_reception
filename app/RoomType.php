<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = [
    	'type', 'description', 'price'
    ];

    public function rooms()
    {
    	return $this->hasMany(Room::class, 'room_type_id');
    }
}
