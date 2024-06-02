<?php

namespace App\Http\Controllers;

use App\Events\SentMessage;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function fetchMessages()
    {
        $messages = \App\Models\Message::with('user')->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new SentMessage($user, $message))->toOthers();

        return response()->json(['message' => $message, 'user' => $user]);
    }
}
