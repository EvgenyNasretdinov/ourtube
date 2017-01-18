<?php

namespace App\Libraries;

use App\Events\NewVideoAdded;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Video;

/**
* Class for Video Stream algorithm
*/
class VideoStream
{
    
    public $event; //event for determing in wich room to start algorithm

    public function __construct()
    {
        // $this->event = $event;
    }

    public function play(){
        
        $videos = DB::table('videos')->orderBy('created_at')->value('youtubeid');
        $videos = collect([$videos]);
        while($videos->isNotEmpty()){

            $currentVideo = $videos->shift();
            
            //get video duration in seconds
            //.............
            $videoDuration = 10;
            
            //event start video
            //............

            sleep($videoDuration);
            
            //event stop video
            //.............

            //database pop
            $videos = DB::table('videos')->orderBy('created_at')->value('youtubeid');            
            $videos = collect([$videos]);
            if ($videos->isEmpty()) {
                break;
            }
            Video::orderBy('created_at')->first()->delete();
            $videos = DB::table('videos')->orderBy('created_at')->value('youtubeid');            
            $videos = collect([$videos]);
        }

    }

}