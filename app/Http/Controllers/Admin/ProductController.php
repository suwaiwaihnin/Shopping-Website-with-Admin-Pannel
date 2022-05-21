<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(10);
        return Inertia::render('Admin/Product/Index',['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return Inertia::render('Admin/Product/Create',['category'=> $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        $file = $request->file('image');
        $name = uniqid().$file->getClientOriginalName();
        $file->move(public_path('/image'),$name);
        $image_name = 'image/'.$name;
        $slug = uniqid().Str::slug($request->name);
        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $image_name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'view_count' => 0
        ]);
        return redirect()->back()->with('success','Product Created Scuuess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->with('category')->first();
        return Inertia::render('Admin/Product/Detail',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        return Inertia::render('Admin/Product/Edit',['category' => $category, 'product'=>$product]);
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
        $product = Product::where('id',$id);
        if($request->file('image')){
            File::delete($product->first()->image);
            $file = $request->file('image');
            $img_name = uniqid().$file->getClientOriginalName();
            File::move(public_path('/image',$img_name));
            $img_path = 'image/'.$img_name;
        }else{
            $img_path = $product->first()->image;
        }
        $slug = uniqid().Str::slug($request->name);
        $product->update([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $img_path,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'view_count' => 0
        ]);
        return redirect()->back()->with('success','Product Updated Scuuess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Product::where('id',$id);
        File::delete($p->first()->image);
        $p->delete();
        return redirect()->back()->with('success','Delete Success');
    }

    public function pendingOrder(){
        $order = ProductOrder::where('status','pending')->with('product','user')->latest()->paginate(10);
        return Inertia::render('Admin/Order',['order' => $order]);
    }

    public function successOrder(){
        $order = ProductOrder::where('status','complete')->with('product','user')->latest()->paginate(10);
        return Inertia::render('Admin/Order',['order' => $order]);
    }

    public function makeSuccess($id){
        ProductOrder::where('id',$id)->update([
            'status' => 'complete'
        ]);
        return redirect()->back()->with('success','Added To Complete');
    }
}
