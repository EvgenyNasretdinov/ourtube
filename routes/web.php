<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/




Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@join');


Auth::routes();


Route::get('/room','RoomController@index');

Route::get('/room/{id}','RoomController@show');

//Route::resource('room', 'RoomController',
                // ['only' => ['index', 'show']]);


// Route::get('/home', 'HomeController@index');


Route::post('/room/chatMessage', function(Request $request){

	$user = Auth::user();

    $message = \App\ChatMessage::create([
        'user_id' => $user->id,
        'message' => $request->input('message')
    ]);

    event(new \App\Events\ChatMessageReceived($message, $user, $user->roomid));
});

Route::post('/room/videoMessage', function(Request $request){
	DB::table('videos')->where('roomid', $request->input('roomid'))->delete();
	\App\Video::create([
    	'youtubeid' => $request->input('message'),
    	'roomid' => $request->input('roomid')
	]);
   event(new \App\Events\NewVideoAdded($request->input('message'), $request->input('roomid')));
});

Route::post('/room/getCurrentVideo', function(Request $request){

	$videos = DB::table('videos')->where('roomid', $request->input('roomid'))->value('created_at');
	$videos = collect([$videos]);
	if ($videos->isNotEmpty()){
		$dbdatetime = DB::table('videos')->where('roomid', $request->input('roomid'))->value('created_at');
		$curdatetime = date("Y-m-d H:i:s");
		$diff = abs(strtotime($curdatetime) - strtotime($dbdatetime));
    	$url = DB::table('videos')->where('roomid', $request->input('roomid'))->value('youtubeid');
    	// error_log($url);
    	event(new \App\Events\CurrentVideo($url, $diff, $request->input('roomid')));
	}
});
