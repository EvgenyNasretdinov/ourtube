<?php

namespace App\Listeners;

use App\Events\NewVideoAdded;
use App\Events\StartPlayer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class NewVideoAddedListener implements ShouldQueue
{

    use InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the NewVideoAdded event.
     *
     * @param  NewVideoAdded  $event
     * @return void
     */
    public function handle(NewVideoAdded $event)
    {

        $videos = DB::table('videos')->value('youtubeid');

        if (empty($videos)){

            \App\Video::create([
                'youtubeid' => $event->videoMessage
            ]);
            event(new StartPlayer());

        } else {

            \App\Video::create([
                'youtubeid' => $event->videoMessage
            ]);

        }

    }
}
