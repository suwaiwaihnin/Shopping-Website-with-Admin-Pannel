<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function pending(){
        $order = ProductOrder::where('user_id',Auth::user()->id)->with('product')->where('status','pending')->latest()->paginate(10);
        return Inertia::render('User/OrderList',['order' => $order]);
    }

    public function complete(){
        $order = ProductOrder::where('user_id',Auth::user()->id)->with('product')->where('status','complete')->latest()->paginate(10);
        return Inertia::render('User/OrderList',['order' => $order]);
    }
}
