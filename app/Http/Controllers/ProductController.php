<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;   // <-- ADD THIS
use Illuminate\Support\Facades\DB;

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
     // ...index, detail, search, addToCart, cartItem as you have...

    public function cart()
    {
        if (!Session::has('user')) return redirect('/login');

        $userId = Session::get('user')['id'];

        // NOTE: table name 'cart' hai – agar aapke DB me 'carts' hai to 'cart' -> 'carts' kar dein
        $items = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select('products.*', 'cart.id as cart_id')
            ->where('cart.user_id', $userId)
            ->get();

        // simple subtotal (har row = 1 qty)
        $subtotal = $items->sum('price');

        return view('cart', compact('items', 'subtotal'));
    }

    public function removeFromCart($cartId)
    {
        if (!Session::has('user')) return redirect('/login');

        DB::table('cart')->where('id', $cartId)->delete();
        return back()->with('success', 'Item removed from cart.');
    }
}
