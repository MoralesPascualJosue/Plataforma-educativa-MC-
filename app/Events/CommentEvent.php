<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $discus;
    public $curso;
    public $estudiantes;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fdiscu,$curso,$estudiantes,$user)
    {
        $this->discus = $fdiscu;
        $this->curso = $curso;
        $this->estudiantes = $estudiantes;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = array();

        foreach ($this->estudiantes as $estudiante) {
            if($estudiante->user_id == $this->user){
            }else {
                array_push($channels, new PrivateChannel('Estudiante.'.$estudiante->user_id));
            }            
        }

        return $channels;
    }
}
