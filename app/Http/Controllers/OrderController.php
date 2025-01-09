<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

use App\Models\Order_detail;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user == null){
            return redirect()->route('login');
        }else{
            $products = session('cart');
            if(count($products) == 0){
                return redirect()->back()->with(["error"=>"Select atleast a product"]);
            }

            $order = Order::create([
                "order_date"=>date('Y-m-d H:m:s'),
                "user_id"=> $user->id,
                "status"=>"pending"
            ]);

            foreach($products as $product){
                $order_detail = new Order_detail([
                    "order_id"=>$order->id,
                    "product_id"=>$product['product'],
                    "quantity"=>$product['qty']
                ]);
                $order_detail->save();
            }

            return redirect()->back()->with(["success"=>"Order made successfully"]);
        }
        //
    }


    public function view(){
        if(auth()->user()->email == "domguiasimoulrich@gmail.com"){
            $orders = Order::all()->toArray();
        }else{
            $orders = Order::all()->where('user_id' ,'=' ,auth()->user()->id)->toArray();
        }
            $orders = array_map(function($order){
                $order['user'] = User::find($order['user_id']);
                return $order;
            } ,$orders);
        // dd($orders);
        return view('order.view' ,compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {   
        $user = auth()->user();
        Order::destroy($order['id'])->where('user_id' ,'=' ,$user->id);
        return redirect()->route('order.view');
        //
    }
}
