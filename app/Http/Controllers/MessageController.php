<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        // $messages = Message::with(['user'])->get();

        // return response()->json($messages);
        $response = [
            'message' => 'This is user message'

        ];

        event(new Message(
            $request->input('username'),
            $request->input('message')
        ));
        // return view('chat');
        return response($response, 201);


    }
}
