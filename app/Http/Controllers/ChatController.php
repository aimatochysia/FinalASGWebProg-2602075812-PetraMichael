<?php
namespace App\Http\Controllers;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// app/Http/Controllers/ChatController.php


class ChatController extends Controller
{
    // Get chat messages between two users
    // app/Http/Controllers/ChatController.php

    public function getChat($friendId)
    {
        $user = Auth::user();

        // Fetch the friend's name based on the friendId
        $friend = User::findOrFail($friendId);

        // Get chat messages between the two users
        $chats = Chat::where(function($query) use ($user, $friendId) {
            $query->where('id_sender', $user->id)
                ->where('id_receiver', $friendId);
        })
        ->orWhere(function($query) use ($user, $friendId) {
            $query->where('id_sender', $friendId)
                ->where('id_receiver', $user->id);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        // Reverse the order of chats for display purposes (oldest first)
        $chats = $chats->reverse();

        return view('chat', compact('user', 'chats', 'friend'));
    }


    // Send a new message
    public function sendMessage(Request $request, $friendId)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        // Store the new message in the database
        Chat::create([
            'id_sender' => $user->id,
            'id_receiver' => $friendId,
            'message' => $request->message,
        ]);

        // Redirect back to the chat page
        return redirect()->route('chat', ['friendId' => $friendId]);
    }
}
