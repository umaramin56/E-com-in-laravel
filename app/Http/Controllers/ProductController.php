<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;   // <-- ADD THIS

class ProductController extends Controller
{
    public function index(){
        $data = Product::all();
        return view('product', ['products' => $data]);
    }

    public function detail($id){
        $data = Product::find($id);
        return view('detail', ['product' => $data]);
    }

    public function search(Request $req){
        $data = Product::where('name','like','%'.$req->input('q').'%')->get();
        return view('search', ['products' => $data]);
    }

    public function addToCart(Request $req){
        if($req->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id   = $req->session()->get('user')['id'];
            $cart->product_id= $req->product_id;
            $cart->save();
            return redirect('/');   // baad me cart page pe bhej sakte ho
        } else {
            return redirect('/login');
        }
    }

    // Navbar counter (video style)
    public static function cartItem(){
        if(!Session::has('user')) return 0;
        return Cart::where('user_id', Session::get('user')['id'])->count();
    }
}
