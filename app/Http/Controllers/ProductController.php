<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;   // <-- ADD THIS
use Illuminate\Support\Facades\DB;
use App\Models\Order;

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
    public function orderNew()
{
    if (!Session::has('user')) return redirect('/login');
    $userId = Session::get('user')['id'];

    $items = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->select('products.*', 'cart.id as cart_id')
        ->where('cart.user_id', $userId)
        ->get();

    $price     = $items->sum('price');           // subtotal
    $tax       = 0;                              // video ke hisaab se 0
    $delivery  = 100;                            // flat
    $total     = $price + $tax + $delivery;

    return view('order_now', compact('items','price','tax','delivery','total'));
}

 // ⬇️ NEW: Replace your old placeOrder() with this one
    public function placeOrder(Request $req){
        if (!Session::has('user')) return redirect('/login');

        $req->validate([
            'address' => 'required|min:6',
            'payment' => 'required|in:online,cod',
        ]);

        $userId = Session::get('user')['id'];

        $productIds = DB::table('cart')
            ->where('user_id', $userId)
            ->pluck('product_id');

        if ($productIds->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // simple: har product ke liye aik order row
        foreach ($productIds as $pid) {
            DB::table('orders')->insert([
                'user_id'        => $userId,
                'product_id'     => $pid,
                'status'         => 'pending',
                'payment_method' => $req->payment,   // online / cod
                'payment_status' => 'pending',
                'address'        => $req->address,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        // cart empty
        DB::table('cart')->where('user_id', $userId)->delete();

        return redirect('/orders')->with('success', 'Order placed successfully!');
    }

    // ⬇️ NEW: Orders listing page
    public function orders(){
        if (!Session::has('user')) return redirect('/login');

        $userId = Session::get('user')['id'];

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select(
                'orders.id','orders.status','orders.payment_method',
                'orders.payment_status','orders.address','orders.created_at',
                'products.name','products.price','products.gallery'
            )
            ->where('orders.user_id', $userId)
            ->orderBy('orders.id','desc')
            ->get();

        return view('orders', compact('orders'));
    }
}
