<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;
class RoomsController extends Controller
{
    
    public function store(Request $request)
    {
        $rules = [
            'price' => 'required',
            'HotelName' => 'required',
            'HotelLocation'=>'required'
        ];

        $input     = $request->only('price','HotelName','HotelLocation');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $room = Rooms::Create([
            'price' => $request->price,
            'HotelName' => $request->HotelName,
            'HotelLocation' => $request->HotelLocation,
        ]);

        return response()->json(['message'=>'room created successfully', 'data'=>$room]);

    }

    public function list(){
        $rooms = Rooms::all();
        return response()->json(['message'=>'rooms generated successfully', 'data'=>$rooms]);
    }

    public function show($id){
        $rooms = Rooms::all();
        $room = $rooms->find($id);
        if(!$room){
            return response()->json(['message'=>'The room you requested was not found']);
        }else{
            return response()->json(['message'=>'room generated successfully', 'data'=>$room]);
        }
        
    }
    
    public function location(Request $request){

       // $rooms = Rooms::where('HotelLocation', $request->location)->get();

        
        $rooms = DB::table('rooms')
        ->where('HotelLocation', 'like', $request->location.'%')
        ->get();
      
        if(!$rooms){
            return response()->json(['message'=>'The room you requested was not found']);
        }else{
            return response()->json(['message'=>'room generated successfully', 'data'=>$rooms]);
        }
        
    }
  
}
