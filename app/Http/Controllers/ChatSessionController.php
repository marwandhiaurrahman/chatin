<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatSessionController extends Controller
{
    public function index()
    {
        return view('chat_session');
    }
}
