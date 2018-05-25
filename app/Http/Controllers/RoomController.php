<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

use App\RoomPhoto;

class RoomController extends Controller
{

    public function all()
    {
        // sleep(3);
        $rooms = Room::orderBy('id', 'asc')
        ->with('photos')
        ->with('type')
        ->get();

        return response()->json($rooms);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('rooms.index');
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

        // sleep(3);

        return response()->json(Room::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::where('id' ,'=', $id)
        ->with('type')
        ->with('photos')
        ->first();

        return response()->json($room);
    }

    public function search(Request $request)
    {
        $rooms = Room::orderBy('name', 'asc')
        ->whereHas('type', function($query) use ($request){
            $query->where('type', 'like', "%{$request->type}%");
        })
        ->with('type')
        ->get();

        return response()->json($rooms);
    }

    public function availables()
    {
        $rooms = Room::where('state', '=', 'available')
        ->with('type')
        ->get();

        return response()->json($rooms);
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return View('rooms.edit')->with('room',$room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        // sleep(3);
        $room->fill($request->all());
        $room->update();
        
        return response()->json($room);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json($room);
    }

    public function uploadPhoto(Request $request)
    {
        if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/rooms/').$name);
        }

       $image= new RoomPhoto();
       $image->src = $name;
       $image->room_id = $request->room_id;
       $image->save();

       return response()->json([
            'message'   => 'You have successfully uploaded an image',
            'img'       =>  $image,
        ], 200);
        // return response()->json($request->all());
    }
    public function getPhotos(Room $room)
    {
        return response()->json($room->photos);
    }
}
