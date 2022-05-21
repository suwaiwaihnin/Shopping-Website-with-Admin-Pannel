<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index(){
        $product = Product::with('category')->latest()->paginate(6);
        // return $product;
        return Inertia::render('User/Index',['product'=>$product]);
    }

    public function productDetail($slug){
        $product = Product::where('slug',$slug)->with('category')->first();
        return Inertia::render('User/ProductDetail',['product'=>$product]);
    }

    public function productByCategory($slug){
        $cat_id = Category::where('slug',$slug)->first()->id;
        $product = Product::where('category_id',$cat_id)->with('category')->latest()->paginate(6);
        return Inertia::render('User/Index',['product'=>$product]);
    }

    public function searchProduct($search){
        $product = Product::where('name','like',"%$search%")->with('category')->latest()->paginate(6);
        return Inertia::render('User/Index',['product'=>$product]);
    }

    public function addToCart($id){
        $isInCart = ProductCart::where('user_id',Auth::user()->id)->where('product_id',$id);
        if($isInCart->first()){
            //need to plus qty
            $isInCart->update([
                'qty' => DB::raw('qty+1')
            ]);
            return redirect()->back()->with('info','Increased Quantity In Your Cart!');
        }else{
            ProductCart::create([
                'user_id'=> Auth::user()->id,
                'product_id' => $id,
                'qty' => 1
            ]);
            return redirect()->back()->with('success','Added To Cart!');
        }
    }

    public function viewCart(){
        $cart = ProductCart::where('user_id',Auth::user()->id)->with('product')->latest()->paginate(10);
        return Inertia::render('User/ViewCart',['cart_data'=>$cart]);
    }

    public function viewCheckout(){
        return Inertia::render('User/ViewCheckout');
    }

    public function Checkout(Request $request){
        $cart = ProductCart::where('user_id',Auth::user()->id);
        foreach($cart->get() as $c){
            ProductOrder::create([
                'user_id' => $c->user_id,
                'product_id' => $c->product_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'qty' => $c->qty
            ]);
        }
        $cart->delete();
        return redirect('/')->with('success','Checkout Success! We will call back soon');
    }

    public function update(){
        return Inertia::render('User/UpdateProfile');
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5'
        ]);
        if($request->password){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::logout();
            return redirect('/login')->with('success','Change Successfully! Please Login Again');
        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return redirect('/')->with('success','Update Successfully!');
        }
    }
}
