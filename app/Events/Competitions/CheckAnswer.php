<?php

namespace App\Events\Competitions;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckAnswer
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $competition;

    /**
     * Create a new event instance.
     *
     * @param $competition
     */
    public function __construct($competition)
    {
        $this->competition = $competition;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('competitions.' . $this->competition->id);
    }
}
