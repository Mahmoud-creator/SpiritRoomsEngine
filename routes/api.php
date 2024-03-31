<?php

use App\Events\SendMessage;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/rooms/all/{activeRoomId}', function (Request $request, $activeRoomId) {

    $chatRooms = Room::all();
    $activeRoom = Room::find($activeRoomId);
    $activeRoom->active = true;

    $randomId = rand(1,100);
    $randomName = 'User' . $randomId;

    $authUser = [
        "id" => $randomId,
        "name" => $randomName,
        "avatar" => 'https://api.dicebear.com/5.x/bottts/svg?seed=' . $randomName
    ];

    $chat = \App\Models\Chat::where('room_id', $activeRoomId)->get()->each(function ($item) {
        $item->time = $item->getMessageTimeColumn();
    });

    return response()->json(['chatRooms' => $chatRooms, 'authUser' => $authUser, 'activeRoom' => $activeRoom, 'chat' => $chat]);
});

Route::post('/chat/send/{roomId}', function (Request $request, $roomId) {
    $userName = $request->input('userName');
    $message = $request->input('message');
    $userId = $request->input('userId');
    info('roomId: ' . $roomId . 'userName: ' . $userName . ' message: ' . $message . ' userId: ' . $userId);
    $chat = \App\Models\Chat::create([
        'room_id' => $roomId,
        'user_name' => $userName,
        'message' => $message,
        'user_id' => $userId
    ]);

    $response = SendMessage::dispatch($userName, $roomId, $message, $userId, $chat);
    Log::info('response: ' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return response()->json(['message' => 'Job dispatched OK']);
});
