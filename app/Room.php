<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
    	'room_type_id', 'name', 'description', 'state'
    ];

    public function photos()
    {
    	return $this->hasMany(RoomPhoto::class, 'room_id');
    }

    public function type()
    {
    	return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function reservations()
    {
    	return $this->hasMany(Reservation::class, 'room_id');
    }
}
