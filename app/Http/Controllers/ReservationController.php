<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function all()
    {
        $reservations = Reservation::with('client')
        ->with('room.type')
        ->orderBy('id', 'desc')
        ->get();

        return response()->json($reservations);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $room = Room::findOrFail($request->room_id);

        $date_entry = Carbon::now();
        $date_exit = Carbon::now()->addHours(8);

        $reservation = Reservation::create([
            'client_id'     =>  $request->client_id,
            'room_id'       =>  $request->room_id, 
            'state'         =>  'busy',
            'date_entry'    =>  $date_entry, 
            'date_exit'     =>  $date_exit,
        ]);

        if($reservation)
        {
            $room->state = 'busy';
            $room->update();
        }

        return response()->json($reservation);
    }

    public function checkSatus(Request $request)
    {
        $now = Carbon::now();
        $response = array(
            'state' => false,
            'data'  =>  array()
        );

        $reservations = Reservation::whereHas('room', function($q){
            $q->where('state', '=', 'busy');
        })
        ->where([
            ['date_exit', '<=', $now],
            ['state', '=', 'busy']
        ])->get();

        if(count($reservations) > 0)
        {
            $response['data'] = $reservations;
            $response['state'] = true;
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::with('client')
        ->with('room.type')
        ->where('id', '=', $id)
        ->first();

        return response()->json($reservation);
    }

    public function getReserveBySate(Request $request)
    {
        $reservation = Room::where('state', '=',  $request->state)->get();

        return response()->json($reservation);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }
    public function evacuate(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
        $room = Room::findOrFail($request->room_id);

        // 
        $reservation->state = 'no_busy';
        $reservation->update();

        // 
        $room->state = "no_busy";
        $room->update();

        return response()->json([
            'reservation'   =>  $reservation,
            'room'          =>  $room
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
