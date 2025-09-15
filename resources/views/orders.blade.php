@extends('master')
@section('content')

<style>
  .o-wrap{ padding:28px 0 60px; }
  .o-title{ font-weight:800; font-size:1.6rem; margin-bottom:18px; }
  .o-card{ border:0; border-radius:18px; overflow:hidden; box-shadow:0 12px 32px rgba(0,0,0,.08); background:#fff; }
  .o-row{ display:grid; grid-template-columns: 70px 1.4fr .7fr .7fr .8fr; gap:14px; align-items:center; padding:14px 18px; border-bottom:1px solid #f1f3f5; }
  .o-row.h{ font-weight:700; background:#f8f9fa; }
  .o-row:last-child{ border-bottom:0; }
  .o-img{ width:60px; height:60px; border-radius:12px; object-fit:cover; }
  .badge-soft{ background:#eef2ff; color:#3b5bdb; border-radius:999px; padding:4px 10px; font-weight:600; font-size:.85rem; }
  .badge-pay{ background:#e7f5ff; color:#1c7ed6; border-radius:999px; padding:4px 10px; font-weight:600; font-size:.85rem; }
  @media (max-width: 992px){
    .o-row{ grid-template-columns: 60px 1fr auto; }
    .hide-md{ display:none; }
  }
</style>

<div class="container o-wrap">
  <h2 class="o-title">My Orders</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="o-card">
    <div class="o-row h">
      <div></div>
      <div>Product</div>
      <div class="hide-md">Price</div>
      <div>Status</div>
      <div class="hide-md">Payment</div>
    </div>

    @forelse($orders as $o)
      <div class="o-row">
        <img src="{{ $o->gallery }}" class="o-img" alt="">
        <div>
          <div class="fw-semibold">{{ $o->name }}</div>
          {{ \Carbon\Carbon::parse($o->created_at)->format('d M Y') }}
          <div class="text-muted small d-md-none mt-1">PKR {{ number_format($o->price,0) }}</div>
        </div>
        <div class="hide-md">PKR {{ number_format($o->price,0) }}</div>
        <div><span class="badge-soft text-capitalize">{{ $o->status }}</span></div>
        <div class="hide-md">
          <span class="badge-pay text-capitalize">{{ $o->payment_method }}</span>
          <div class="text-muted small">{{ ucfirst($o->payment_status) }}</div>
        </div>
      </div>
    @empty
      <div class="p-4 text-muted">No orders yet.</div>
    @endforelse
  </div>
</div>
@endsection
