<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function getHistory()
    {
        $number = 1;

        // $data = Message::all();

        // $data = User::join('messages', 'users.id', '=', 'messages.user_id')
        // ->get(['users.*', 'messages.message', 'messages.created_at']);

        $data =  DB::table('messages')
        ->select(
        'messages.message',
        'messages.created_at',
        'users.name',
        )
    ->join('users','users.id','=','messages.user_id')
    ->where('sender', '!=', 'admin' )
    ->latest()
    ->get();
    // ->paginate(5);

        // echo $data;
        // echo $user->name;

        return view('admin.history', [
            'items' => $data,
            'number' => $number
        ]);
    }
}
