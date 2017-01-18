<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
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


    /**
     * Redirect user to choosed room
     *
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {
        $url = $request->input('room-url');

        if (preg_match('/room/', $url)){

            $pos = strpos($url, 'room');
            $roomID = substr($url, $pos+5);
            
            if ((!strpos($roomID, '/'))&&(!empty($roomID))){

                return redirect('room/'.$roomID);
            
            }

        }
        if (empty($url)){
            return redirect('room/'.uniqid());
        }
        return view('home');
    }

}
