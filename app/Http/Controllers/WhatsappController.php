<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatSession;
use App\Models\User;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function webhook(Request $request)
    {
        $user = User::firstWhere('username', $request->username);
        $request['user_id'] = $user->id;
        $this->create_chat_sesstion($request);
        $this->save_chat($request);
        dd($request->all());
    }

    public function create_chat_sesstion(Request $request)
    {
        ChatSession::updateOrCreate(
            [
                'number' => $request->number,
            ],
            [
                'chatid' => $request->chatid,
                'contact' => $request->contact,
                'message' => $request->message,
                'isGroup' => $request->isGroup,
                'status' => 1,
                'user_id' => $request->user_id,
            ]
        );
        return true;
    }
    public function save_chat(Request $request)
    {
        Chat::create($request->all());
    }
}
