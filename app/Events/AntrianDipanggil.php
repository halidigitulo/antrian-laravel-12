<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianDipanggil implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nomor;
    public $loket;
    public $broadcastQueue = 'default';

    /**
     * Create a new event instance.
     */
    public function __construct($queueNumber, $loketId)
    {
        $this->nomor = $queueNumber;
        $this->loket = $loketId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('antrian-channel');
    }

    public function broadcastAs()
    {
        return 'antrian-dipanggil';
    }

    public function broadcastWith()
    {
        return [
            'queueNumber' => $this->nomor,
            'loketId' => $this->loket,
        ];
    }
}
