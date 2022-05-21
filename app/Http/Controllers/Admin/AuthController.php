<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin(){
        return Inertia::render('Admin/Login');
    }

    public function authenticate(Request $request){
        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            //authentication pass
            $user = Auth::user();
            if($user->role == 'admin'){
                return redirect('admin/dashboard');
            }else{
                return redirect('/admin/login')->with('error','You are not admin yet');

            }
        }
        else{
            return redirect('/admin/login')->with('error','Email and Password does not match');
        }
    }

    public function dashboard(){
        $data = [];
        $data['category'] = Category::count();
        $data['product'] = Product::count();
        $data['pending'] = ProductOrder::where('status','pending')->count();
        $data['complete'] = ProductOrder::where('status','complete')->count();
        $data['user'] = User::latest()->take(5)->get();
        return Inertia::render('Admin/Dashboard',['data'=>$data]);
    }
}
