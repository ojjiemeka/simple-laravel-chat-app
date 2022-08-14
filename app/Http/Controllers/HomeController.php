<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userInfo = Auth::user();
        $number = 1;

        // echo $userInfo;
        $userID = $userInfo->id;

          $data = User::join('messages', 'users.id', '=', 'messages.user_id')
          ->where('users.id', '=', $userID)
        ->get(['messages.*']);

        // echo $data;

        return view('home',[
            'user' => $userInfo,
            'datas' => $data,
            'number' => $number
        ]);
    }

    public function message()
    {
        $userInfo = Auth::user();
        $number = 1;


        // echo $userInfo;
        $userID = $userInfo->id;

          $data = User::join('messages', 'users.id', '=', 'messages.user_id')
          ->where('users.id', '=', $userID)
        ->get(['messages.*']);

        $adminMessage = User::join('messages', 'users.id', '=', 'messages.reciever')
        ->where('messages.reciever', '=', $userID)
        ->get(['messages.*']);

        // echo $adminMessage;

        return view('user.chat',[
            'user' => $userInfo,
            'datas' => $data,
            'number' => $number,
            'admins' => $adminMessage
        ]);
    }

    public function sendMessage(Request $request)
    {
        $userInfo = Auth::user();

        // echo $userInfo;

        $this->validate($request, [
            'message' => ['required', 'string', 'max:255'],
        ]);

        $sql = new Message();
        $sql->message = $request->input('message');
        $sql->user_id = $userInfo->id;
        $sql->sender = $userInfo->id;
        $sql->reciever = 'admin';
        $sql->save();

        // echo $sql;

        return $this->message();

    }


}
