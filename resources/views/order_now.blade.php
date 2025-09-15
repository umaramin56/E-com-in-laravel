@extends('master')
@section('content')

<style>
  .ck-wrap{ padding:28px 0 60px; }
  .ck-title{ font-weight:800; font-size:1.6rem; margin-bottom:18px; }
  .ck-grid{ display:grid; grid-template-columns: 1.4fr .9fr; gap:22px; }
  .ck-card{ border:0; border-radius:18px; overflow:hidden; box-shadow:0 12px 32px rgba(0,0,0,.08); background:#fff; }
  .ck-card .hd{ padding:16px 18px; font-weight:700; border-bottom:1px solid #f1f3f5; }
  .ck-card .bd{ padding:18px; }
  .ck-row{ display:flex; gap:14px; align-items:center; padding:10px 0; border-bottom:1px dashed #eef1f4; }
  .ck-row:last-child{ border-bottom:0; }
  .ck-img{ width:70px; height:70px; object-fit:cover; border-radius:12px; flex:0 0 70px; }
  .ck-name{ font-weight:600; margin:0; }
  .ck-desc{ margin:2px 0 0; color:#6c757d; font-size:.9rem; }
  .ck-price{ font-weight:700; white-space:nowrap; }
  .sum-table{ width:100%; }
  .sum-table tr td{ padding:10px 0; }
  .sum-table tr td:first-child{ color:#6c757d; }
  .sum-total{ font-weight:800; font-size:1.1rem; }
  .pay-opt{ display:flex; gap:12px; align-items:center; padding:10px 12px; border:1px solid #e9ecef; border-radius:12px; cursor:pointer; }
  .pay-opt input{ margin-right:6px; }
  .btn-xl{ padding:.85rem 1.25rem; font-weight:700; border-radius:12px; }
  @media (max-width: 992px){ .ck-grid{ grid-template-columns: 1fr; } }
</style>

<div class="container ck-wrap">
  <h2 class="ck-title">Checkout</h2>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="ck-grid">

    {{-- LEFT: Address + Payment --}}
    <div class="ck-card">
      <div class="hd">Shipping & Payment</div>
      <div class="bd">
        <form action="{{ route('order.place') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold">Delivery Address</label>
            <textarea name="address" rows="4" class="form-control" placeholder="Street, City, ZIP" required>{{ old('address') }}</textarea>
            @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold d-block mb-2">Payment Method</label>

            <label class="pay-opt">
              <input type="radio" name="payment" value="online" {{ old('payment','online')=='online'?'checked':'' }}>
              <div>
                <div class="fw-semibold">Online Payment</div>
                <div class="text-muted small">Secure card / wallet (demo)</div>
              </div>
            </label>

            <label class="pay-opt mt-2">
              <input type="radio" name="payment" value="cod" {{ old('payment')=='cod'?'checked':'' }}>
              <div>
                <div class="fw-semibold">Cash on Delivery</div>
                <div class="text-muted small">Pay when you receive the item</div>
              </div>
            </label>

            @error('payment') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>

          <button class="btn btn-success btn-xl w-100 mt-2">
            Order Now
          </button>
        </form>
      </div>
    </div>

    {{-- RIGHT: Order Summary --}}
    <div class="ck-card">
      <div class="hd">Order Summary</div>
      <div class="bd">
        {{-- Items list (like video) --}}
        @foreach($items as $p)
          <div class="ck-row">
            <img src="{{ $p->gallery }}" class="ck-img" alt="">
            <div class="flex-grow-1">
              <p class="ck-name">{{ $p->name }}</p>
              <p class="ck-desc">{{ \Illuminate\Support\Str::limit($p->description, 70) }}</p>
            </div>
            <div class="ck-price">PKR {{ number_format($p->price, 0) }}</div>
          </div>
        @endforeach

        {{-- Totals table (Price/Tax/Delivery/Total) --}}
        <table class="sum-table mt-3">
          <tr>
            <td>Price</td>
            <td class="text-end fw-semibold">PKR {{ number_format($price, 0) }}</td>
          </tr>
          <tr>
            <td>Tax</td>
            <td class="text-end fw-semibold">PKR {{ number_format($tax, 0) }}</td>
          </tr>
          <tr>
            <td>Delivery</td>
            <td class="text-end fw-semibold">PKR {{ number_format($delivery, 0) }}</td>
          </tr>
          <tr>
            <td class="sum-total">Total Amount</td>
            <td class="text-end sum-total">PKR {{ number_format($total, 0) }}</td>
          </tr>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection
