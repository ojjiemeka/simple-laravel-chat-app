<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    protected function index (Request $request){
        return view('admin.login');
    }


    protected function register(Request $request)
    {
        $user = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'avatar' => ['required', 'image' ,'mimes:jpg,jpeg,png','max:1024'],
        ]);


        $now = Carbon::today()->toDateString();

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')) ;
        $user->role = "admin";
        $user->status = "active";
        // $user->created_at = $now;
        $user->save();

        $message = 'User Created';

        return redirect('/login');

        // echo $input;

    }

    protected function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            if(Auth::check() && Auth::user()->role === 'admin'){
                 Session::flash('success', 'Welcome Admin');
                Session::flash('alert-class', 'alert-success');
                return redirect('/dashboard')->withErrors([
                    'isSuccess' => true,
                    'message' => "Welcome Admin"
                ], 200);
            // return ('it works');
            }

        }else{
            Session::flash('error', 'Invalid Credentials!!! Check Username Or Password');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/admin-login')->withErrors([
                    'isSuccess' => true,
                    'message' => "Invalid Credentials!!! Check Username Or Password"
                ], 200);
            // return ('error 2');

        }

    }

    protected function dashboard (Request $request){
        $users = User::where('role', 'user')
        ->get();

        $number = 1;


        return view('admin.dashboard', [
            'users' => $users,
            'number' => $number
        ]);
    }

}
