<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Laravel\Reverb\Loggers\Log;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userName;
    public $roomId;
    public $message;
    public $userId;
    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct(string $userName, int $roomId, string $message, int $userId, Chat $chat)
    {
        $this->userName = $userName;
        $this->roomId = $roomId;
        $this->message = $message;
        $this->userId = $userId;
        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        info("broadcastOn: Broadcasting SendMessage event: {$this->message}");
        return new Channel('newChannel');
    }

    public function broadcastWith(): array
    {
        info("broadcastWith: Broadcasting SendMessage event: {$this->message}");
        return [
            "id" => $this->chat->id,
            "roomId" => $this->chat->room_id,
            "userName" => $this->chat->user_name,
            "message" => $this->chat->message,
            "userId" => $this->chat->user_id,
            "created_at" => $this->chat->created_at,
            "updated_at" => $this->chat->updated_at,
            'time' => now()->format('H:i A'),
        ];
    }

    public function failed(): void
    {
        Log::error("Failed to broadcast SendMessage event: {$this->message}");
    }
}
