<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Repositories\cursoRepository;
use App\Models\Estudiante;
use App\Notifications\CommentNotification;

class CommentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(cursoRepository $cursoRepo)
    {
        $this->cursoRepository = $cursoRepo;
    }

    /**
     * Handle the event.
     *
     * @param object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->cursoRepository->find($event->curso->id)->estudiantes()->each(function(Estudiante $estudiante) use ($event){            
            if($estudiante->user_id == $event->user){

            }else {
                Notification::send($estudiante, new CommentNotification($event->discus,$event->curso));
            }            
        });
    }
}
