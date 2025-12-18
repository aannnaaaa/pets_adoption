<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'receiver', 'announcement'])
            ->where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->orderBy('sent_at', 'desc')
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::with(['sender', 'receiver', 'announcement'])->findOrFail($id);

        if ($message->sender_id !== Auth::id() && $message->receiver_id !== Auth::id()) {
            return redirect('/error')->with('message', 'У вас нет доступа к этому сообщению');
        }

        if ($message->receiver_id === Auth::id() && is_null($message->read_at)) {
            $message->update(['read_at' => now()]);
        }

        return view('messages.show', compact('message'));
    }
}

