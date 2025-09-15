@extends('master')
@section('content')

<style>
  .cart-wrap{ padding:28px 0 60px; }
  .cart-title{ font-weight:700; font-size:1.4rem; margin-bottom:16px; }
  .card-cart{
    border:0; border-radius:14px; overflow:hidden;
    box-shadow:0 10px 26px rgba(0,0,0,.08);
  }
  .cart-row{ display:flex; align-items:center; gap:14px; padding:14px; border-bottom:1px solid #f1f3f5; }
  .cart-row:last-child{ border-bottom:0; }
  .cart-img{ width:80px; height:80px; object-fit:cover; border-radius:10px; flex:0 0 80px; }
  .cart-info{ flex:1 1 auto; min-width:0; }
  .cart-name{ font-weight:600; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  .cart-desc{ margin:2px 0 0; color:#6c757d; font-size:.9rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  .cart-price{ font-weight:700; color:#0d6efd; }
  .cart-actions{ display:flex; align-items:center; gap:8px; }
  @media (max-width:576px){
    .cart-row{ align-items:flex-start; }
    .cart-actions{ margin-left:auto; }
  }
</style>

<div class="container cart-wrap">
  <h2 class="cart-title">Your Cart</h2>

  @if(session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
  @endif

  @if($items->count())
    <div class="card card-cart">
      @foreach($items as $p)
        <div class="cart-row">
          <img src="{{ $p->gallery }}" alt="" class="cart-img">
          <div class="cart-info">
            <p class="cart-name">{{ $p->name }}</p>
            <p class="cart-desc">{{ \Illuminate\Support\Str::limit($p->description, 80) }}</p>
          </div>
          <div class="cart-price">PKR {{ number_format($p->price, 0) }}</div>
          <div class="cart-actions">
            <a href="{{ url('detail/'.$p->id) }}" class="btn btn-sm btn-outline-primary">View</a>
            <form action="{{ route('cart.remove', $p->cart_id) }}" method="POST" class="m-0">
              @csrf
              <button class="btn btn-sm btn-outline-danger">Remove</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <div class="d-flex justify-content-end align-items-center mt-3 gap-3">
      <h5 class="m-0">Subtotal: <span class="text-primary">PKR {{ number_format($subtotal, 0) }}</span></h5>
      <a href="{{ route('order.now') }}" class="btn btn-dark">Checkout</a>

    </div>
  @else
    <p class="text-muted">Your cart is empty.</p>
  @endif
</div>

@endsection
