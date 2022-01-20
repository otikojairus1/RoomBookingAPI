<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{
    public function book(Request $request){


        $rules = [
            'email' => 'required',
            'RoomNo' => 'required',
            'HotelName'=>'required',
            'HotelLocation'=>'required',
            'pricePaid'=>'required|int'
        ];

        $input     = $request->only('email','RoomNo','HotelName','HotelLocation', 'pricePaid');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

    
        $new = Bookings::Create([
            'email'=>$request->email,
            'RoomNo'=>$request->RoomNo,
            'HotelName'=>$request->HotelName,
            'HotelLocation'=>$request->HotelLocation,
            'pricePaid'=>$request->pricePaid,
        ]);

        return response()->json(['message'=>'your room was successfully booked']);

    }

    public function list(){
        $bookedRooms = Bookings::all();
        return response()->json(['data'=>$bookedRooms]);
    }

    public function listcustomer(Request $request){

        
        $rules = [
            'email' => 'required',
        
        ];

        $input     = $request->only('email');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }


        $bookedRooms = Bookings::where('email', $request->email)->get();
        return response()->json(['data'=>$bookedRooms]);
    }
}
