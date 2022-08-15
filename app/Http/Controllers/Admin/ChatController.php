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

    public function getUserInfo(){
        $userInfo = Auth::user();

        return $userInfo;
    }

    public function getUserMessage($id){

        $data = Message::where('user_id', $id)
                ->oldest()
                ->get();

        return $data;
        // dd($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        $sql = new Message();
        $sql->message = $request->input('message');
        $sql->user_id = $request->input('user_id');
        $sql->sender = 'admin';
        $sql->reciever = $request->input('user_id');
        $sql->save();

        // echo $sql;

        return redirect()->route('chats.show', [$id]);
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

        $message = $this->getUserMessage($id);

        // echo $message;
        // echo $user->id;

        return view('admin.show', [
            'messages' => $message,
            'user' => $user,
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
