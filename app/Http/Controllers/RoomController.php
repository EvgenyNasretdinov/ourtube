<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;


class RoomController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Room Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles actions in room
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function show($roomID)
    {
        $user = Auth::user();
        User::where('id', $user->id)->update(array('roomid' => $roomID));

        return view('room');
    }

}
