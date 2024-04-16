<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Auth;

class PostCreatedListner
{
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
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        //
        $post=$event->post;
        $user = Auth::user();
        sendEmail('post_created_ack', array('title' => $post->title,
            'to_email' => $user->email,
            'name' => $user->name,
            'date' => date('d M, Y',strtotime($post->created_at)),
            'desc' => $post->description,
            'url' => BASE_PATH));

    }
}
