<?php

namespace App\Events\Competitions;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateScores implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $competition;
    public $scores;

    /**
     * Create a new event instance.
     *
     * @param $competition
     * @param $user
     * @param $scores
     */
    public function __construct($competition, $user, $scores)
    {
        $this->competition = $competition;
        $this->user = $user;
        $this->scores = $scores;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('competitions.'. $this->competition->id);
    }
}
