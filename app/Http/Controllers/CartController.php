<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart') ? session()->get('cart'): [];
        // dd($cart);
        $total_price = 0;
        $product_indexes = array_map(function($product){
            return $product['product'];
        } ,$cart);

        $products = Product::findMany($product_indexes)->toArray();
        $products = array_map(function($product) use ($cart ,&$total_price){
            $qty = 1;
            for($i=0;$i<count($cart);$i++){
                if($product['id'] == $cart[$i]['product']){
                    $qty = $cart[$i]['qty'];
                }
            }
            $product['qty'] = $qty;
            $total_price = $total_price + ($product['price'] * $product['qty']); 
            return $product;
        } ,$products);
        
        // dd($total_price);
        return view('cart' ,compact('products' ,'total_price'));
    }


    // Function to add an item to the cart
    public function addToCart(Product $product){
        $cart = session()->get('cart');
        if($cart == null || count($cart) == 0){
            session()->put('cart' ,[['product'=>$product->id ,'qty'=>1]]);
        }else{
            $test = false;
            for($i=0;$i<count($cart);$i++){
                if($cart[$i]['product'] == $product->id){
                    $test = true;
                }
                if(!$test){
                    array_push($cart ,['product'=>$product->id ,'qty'=>1]);
                    session()->put('cart' ,$cart);
                }
            }
        }
        // dd(session()->get('cart'));  
        return redirect()->route('home');
    }


    // Function to remove an item from the cart
    public function removeFromCart(Product $product){
        $cart = session()->get('cart');
        // print_r($cart);
        if($cart !=  null && count($cart) > 0){
            $cart = array_filter($cart ,function($value) use ($product){
                return $value['product'] != $product->id;
            });
            session()->put('cart' ,$cart);
        }
        // dd($cart);
        return redirect()->back();
    }


    // Function to increase the quantity of a selected product
    public function increaseQuantity(Product $product){
        $cart = session()->get('cart');
        $updated_cart = array_map(function($item) use ($product){
            if($item['product'] == $product->id){
                if( $item['qty'] < $product->stock  ){
                    $item['qty'] = $item['qty']+1; 
                }
            }
            return $item;
        } ,$cart);
        session()->put('cart' ,$updated_cart);
        return redirect()->back();
    }


    // Function to decrease the quantity of a selected product
    public function decreaseQuantity(Product $product){
        $cart = session()->get('cart');
        $updated_cart = array_map(function($item) use ($product){
            if($item['product'] == $product->id){
                if( $item['qty'] > 1 ){
                    $item['qty'] = $item['qty']-1; 
                }
            }
            return $item;
        } ,$cart);
        session()->put('cart' ,$updated_cart);
        return redirect()->back();
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        session()->forget('cart');
        return redirect()->route('home');
        //
    }
}
