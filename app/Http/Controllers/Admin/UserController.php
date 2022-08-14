<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userInfo = User::find($id);

        // echo $userInfo;

        return view('admin.update', [
            'user' => $userInfo
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
        $this->validate($request, [
            'status' => ['required', 'string', 'max:255'],
        ]);

        $user = User::find($id);
        $user->status = $request->input('status');
        $user->save();
        // echo $user->status;

        if ($user) {
            Session::flash('success', 'Update Successful');
             Session::flash('alert-class', 'alert-success');
         return redirect('/dashboard')->withErrors([
             'isSuccess' => true,
            'message' => "Update Successful"
         ], 200);
        // //      // Status code here
        // //     // return view()->with('success','Product successfully added.');
         } else {
            Session::flash('error', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');

             return redirect()->back()->withErrors([
                'isSuccess' => true,
                'message' => "Something Went Wrong!!"
            ], 200);
         }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
    }
}
