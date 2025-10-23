<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'receiver', 'announcement'])->get();
        return view('messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::with(['sender', 'receiver', 'announcement'])->findOrFail($id);
        return view('messages.show', compact('message'));
    }
}

