<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin(){
        return Inertia::render('Auth/Login');
    }

    public function postLogin(Request $request){
        $cre = $request->only('email','password');
        if(Auth::attempt($cre)){
            $user = Auth::user();
            return redirect('/')->with('success','Welcome '.$user->name);
        }else{
            return redirect()->back()->withErrors(['error'=>'Email and Password Dont Match']);
        }
    }

    public function showRegister(){
        return Inertia::render('Auth/Register');
    }

    public function postRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5'
        ]);
        //create
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        //Auth
        $cre = $request->only('email','password');
        if(Auth::attempt($cre)){
            return redirect('/')->with('success','Welcome '.$request->name);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
