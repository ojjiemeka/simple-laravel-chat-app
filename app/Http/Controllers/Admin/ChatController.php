<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getUsers(): Collection
    {
        $response = [
            'message' => "it works"
        ];

        return User::where('role', 'user')
        // ->first();
        ->get();
    }

    public function getUserInfo(){
        $userInfo = Auth::user();

        return $userInfo;
    }

    public function getAdminMessage($id){
        // $user = User::find($id);

        // $adminMessage = User::join('messages', 'users.id', '=', 'messages.reciever')
        // ->where('messages.reciever', '=', $id)
        // ->get(['messages.*']);


        $adminMessage = Message::find($id)->where('messages.reciever', '=', $id)->get();


        return $adminMessage;
    }

    public function getUserMessage($id){
        // $user = User::find($id);

         // $data = User::join('messages', 'users.id', '=', 'messages.user_id')
        // ->where('users.id', '=', $id)
        // ->get(['users.*', 'messages.message', 'messages.created_at']);

        // $data = Message::find($id)->where('user_id', '=', $id)->get();

        $data = Message::find($id)
                    ->join('users', 'users.id', '=', 'messages.user_id')
                    ->where('user_id', '=', $id)
                    ->get();



        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getUsers = $this->getUsers();

        return view('admin.chat', [
            'users' => $getUsers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @param  int  $id
     *
     */
    public function store(Request $request )
    {
        $this->validate($request, [
            'message' => ['required', 'string', 'max:255'],
        ]);

        $id = $request->input('user_id');

        $myID = Auth::user()->id;


        // $user = User::find($id);
        $sql = new Message();
        $sql->message = $request->input('message');
        $sql->user_id = $myID;
        $sql->sender = 'admin';
        $sql->reciever = $request->input('user_id');

        $sql->save();

        // echo $sql;

        return $this->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);

        // $data = Message::find($id)->where('user_id', '=', $id)->get();
        $data = $this->getUserMessage($id);


        // $adminMessage = Message::find($id)->where('messages.reciever', '=', $id)->get();
        $adminMessage= $this->getAdminMessage($id);

        // echo $adminMessage;
        // echo $data;

        return view('admin.show', [
            'messages' => $data,
            'user' => $user,
            'admins' => $adminMessage
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
