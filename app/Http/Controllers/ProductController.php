<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        if(auth()->user()->email != "domguiasimoulrich@gmail.com"){
            return redirect()->back();
        }
        return view('dashboard.view' ,compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if(auth()->user()->email != "domguiasimoulrich@gmail.com"){
            return redirect()->back();
        }
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $file_path = $request->image->store("uploads" ,"public");
        $product = Product::create([
            "name"=>$request->name,
            "price"=>$request->price,
            "description"=>$request->description,
            "stock"=>$request->quantity,
            "img"=>$file_path
        ]);
        return view('dashboard.create')->with("status" ,"succes");
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // dd($product);
        return view('dashboard.edit' ,compact('product'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request ,$product);
        $product->name = $request->name;
        $product->price = $request->price; 
        $product->description = $request->description; 
        $product->stock = $request->quantity; 

        // $product = [
        //     "name"=>$request->name,
        //     "price"=>$request->price,
        //     "description"=>$request->description,
        //     "stock"=>$request->quantity,
        // ];

        $product->save();
        return Redirect::route('dashboard.view');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // dd($product);
        Product::destroy($product->id);
        return Redirect::route('dashboard.view');
        //
    }
}
