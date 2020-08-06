<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Repositories\CursoRepository;
use App\Models\Estudiante;
use App\Notifications\ActivitieNotification;

class ActivitieListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $cursoRepository;

    public function __construct(CursoRepository $cursoRepo)
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
        $this->cursoRepository->find($event->curso)->estudiantes()->each(function(Estudiante $estudiante) use ($event){
            Notification::send($estudiante, new ActivitieNotification($event->activitie));
        });
    }
}
