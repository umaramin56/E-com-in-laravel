<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () {
    return view('login');})->middleware('userauth'); 
    use Illuminate\Support\Facades\Session;

Route::get('/logout', function () {
    Session::forget('user');   // sirf 'user' session remove karega
    return redirect('/login'); // logout ke baad login page pe bhej dega
});
  // 👈 Yahan bhi middleware lagao
//Route::view('/login', 'login');
Route ::post('/login',[UserController::class,'login']);
Route::get('/', [ProductController::class, 'index']);
Route::get('detail/{id}', [ProductController::class, 'detail']);
Route::get('search', [ProductController::class, 'search']);
Route::post('add_to_cart', [ProductController::class, 'addToCart'])->middleware('userauth');
// routes/web.php

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');  // (optional) ->middleware('userauth')
Route::post('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');


