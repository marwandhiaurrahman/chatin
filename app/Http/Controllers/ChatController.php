<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $chat_sessions = ChatSession::get();
        $chats = null;
        if ($request->number) {
            $chats =  Chat::where('number', $request->number)->get();
        }
        return view('chat', compact([
            'chat_sessions',
            'chats',
            'request',
        ]));
    }
    public function store(Request $request)
    {
        $wa = new WhatsappController();
        $wa->send_message($request);
        return redirect()->back();
    }
}
