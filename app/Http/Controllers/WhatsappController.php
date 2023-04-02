<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function webhook(Request $request)
    {
        $user = User::firstWhere('username', $request->username);
        $request['user_id'] = $user->id;
        if (!$request->isGroup) {
            $this->create_chat_sesstion($request);
            $this->save_chat($request);
        }
        return 1;
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
        $request['direct'] = 'in';
        Chat::create($request->all());
    }
    public function send_message(Request $request)
    {
        $url =  "http://127.0.0.1:3000/send-message";
        $response = Http::post($url, [
            'number' => $request->number,
            'message' => $request->message,
            'username' => 'marwan',
        ]);
        $response = json_decode($response->getBody());

        $request['direct'] = 'out';
        $request['chatid'] = uniqid();
        $request['username'] = 'marwan';
        $request['user_id'] = '1';
        Chat::create($request->all());

        return $response;
    }
}
