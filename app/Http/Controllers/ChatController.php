<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChatRoomUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = ChatRoomUsers::where('user_id', '!=', 1)
            ->join('users', 'chat_room_users.user_id', '=', 'users.id')
            ->select('chat_room_users.*', 'users.*')
            ->get();

        return view('dashboard.chats', compact('users'));
    }

    public function room($room)
    {
        // Get room
        $room = DB::table('chat_rooms')->where('id', $room)->first();

        // Get users
        $users = DB::table('chat_room_users')->where('chat_room_id', $room->id)->get();

        $redirectView = 'chat';

        if (Auth::user()->role == "admin") $redirectView = 'dashboard.chat-admin';

        return view($redirectView, compact('room', 'users'));
    }

    public function getChat($room)
    {
        // Join with user
        $chats = DB::table('chats')
            ->join('users', 'users.id', '=', 'chats.user_id')
            ->where('chat_room_id', $room)
            ->select('chats.*', 'users.name as user_name')
            ->get();

        return response()->json($chats);
    }

    // Send chat
    public function sendChat(Request $request)
    {
        $chat = DB::table('chats')->insert([
            'chat_room_id' => $request->room,
            'user_id' => auth()->user()->id,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Trigger event
        broadcast(new ChatEvent($request->room, $request->message, auth()->user()->id));

        return response()->json($chat);
    }

    public function chat($user)
    {
        $my_id = auth()->user()->id ?? 1;
        $target_id = $user;

        $my_room = DB::table('chat_room_users');
        $target_room = clone $my_room;

        // Get my room
        $my_room = $my_room->where('user_id', $my_id)->get()->keyBy('chat_room_id')->toArray();
        // Get target room
        $target_room = $target_room->where('user_id', $target_id)->get()->keyBy('chat_room_id')->toArray();

        // Check room
        $room = array_intersect_key($my_room, $target_room);

        // If room exists
        if ($room) return redirect()->route('chat.room', ['room' => array_keys($room)[0]]);

        // If room doesn't exist
        $uuid = Str::orderedUuid();
        $room = DB::table('chat_rooms')->insert([
            'id' => $uuid,
            'name' => 'generate by system',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Add users to room
        DB::table('chat_room_users')->insert([
            [
                'chat_room_id' => $uuid,
                'user_id' => $my_id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'chat_room_id' => $uuid,
                'user_id' => $target_id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $redirectRoute = 'chat.room';

        if (Auth::user()->role == "admin") $redirectRoute = 'chat.room.admin';

        return redirect()->route($redirectRoute, ['room' => $uuid]);
    }
}
