<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function getUserInfo(){
        $userInfo = Auth::user();

        return $userInfo;
    }

    public function getUserMessage(){
        $userInfo = Auth::user();
        $userID = $userInfo->id;
        $data = Message::find($userID)->where('user_id', '=', $userID)->get();

        return $data;

    }


    public function index()
    {
        $number = 1;

        $userInfo = $this->getUserInfo();

        $data = $this->getUserMessage();

        // echo $data;
        // dd($data);

        return view('home',[
            'user' => $userInfo,
            'datas' => $data,
            'number' => $number
        ]);
    }

    public function message()
    {
        $userInfo = $this->getUserInfo();

        $number = 1;

        // echo $userInfo;

        $data = Message::find($userInfo->id)->where('user_id', '=', $userInfo->id)->get();

        $adminMessage = Message::find($userInfo->id)->where('messages.reciever', '=', $userInfo->id)->get();

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
