<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Repositories\cursoRepository;
use App\Models\Estudiante;
use App\Notifications\TestNotification;

class TestListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $cursoRepository;

    public function __construct(cursoRepository $cursoRepo)
    {
        $this->cursoRepository = $cursoRepo;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->cursoRepository->find($event->curso->id)->estudiantes()->each(function(Estudiante $estudiante) use ($event){
            Notification::send($estudiante, new TestNotification($event->test,$event->curso));
        });
    }
}
