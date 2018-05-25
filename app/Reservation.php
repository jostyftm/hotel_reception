<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    	'client_id', 'room_id', 'state', 'price', 'date_entry', 'date_exit'
    ];

    public function client()
    {
    	return $this->belongsTo(User::class, 'client_id');
    }

    public function room()
    {
    	return $this->belongsTo(Room::class, 'room_id');
    }
}
