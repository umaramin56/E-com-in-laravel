@extends('master')
@section('content')

<style>
.detail-wrap {
    padding: 24px 0 60px;
}

.back-link {
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #0d6efd;
}

.detail-card {
    border: 0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(0, 0, 0, .10);
    background: #fff;
}

.detail-gallery img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    object-position: center;
}

@media (max-width: 576px) {
    .detail-gallery img {
        height: 300px;
    }
}

.price-badge {
    font-weight: 700;
    font-size: 1.6rem;
    background: #e7f1ff;
    color: #0d6efd;
    border-radius: 12px;
    padding: 8px 14px;
    display: inline-block;
}

.meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 12px;
}

.meta .badge {
    font-weight: 500;
}

.specs {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

@media (max-width: 576px) {
    .specs {
        grid-template-columns: 1fr;
    }
}

.specs .item {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 10px 12px;
}

.qty-box {
    max-width: 140px;
}
</style>

<div class="container detail-wrap">
    <a href="{{ url('/') }}" class="back-link mb-3">
        <i class="bi bi-arrow-left"></i> Go Back
    </a>

    <div class="card detail-card">
        <div class="row g-0">
            {{-- LEFT: Image --}}
            <div class="col-lg-6">
                <div class="detail-gallery h-100">
                    <img src="{{ $product->gallery }}" alt="{{ $product->name }}">
                </div>
            </div>

            {{-- RIGHT: Info --}}
            <div class="col-lg-6">
                <div class="p-4 p-lg-5">
                    <h2 class="mb-2">{{ $product->name }}</h2>

                    <div class="meta">
                        <span class="badge text-bg-light">Category: <strong>{{ $product->category }}</strong></span>
                        <span class="badge text-bg-light">SKU: <strong>#{{ $product->id }}</strong></span>
                    </div>

                    <div class="mb-3">
                        <span class="price-badge">PKR {{ number_format($product->price, 2) }}</span>
                    </div>

                    <p class="text-secondary mb-3">
                        {{ $product->description }}
                    </p>

                    {{-- Quick specs (optional: map your own fields if available) --}}
                    <div class="specs mb-4">
                        <div class="item"><small class="text-muted d-block">Availability</small> In Stock</div>
                        <div class="item"><small class="text-muted d-block">Warranty</small> 1 Year</div>
                        <div class="item"><small class="text-muted d-block">Returns</small> 7-Day</div>
                        <div class="item"><small class="text-muted d-block">Delivery</small> 2–5 Days</div>
                    </div>

                    <form action="{{ url('add_to_cart') }}" method="POST" class="mb-3 d-flex align-items-center gap-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group qty-box">
                            <span class="input-group-text">Qty</span>
                            <input type="number" name="quantity" class="form-control" min="1" value="1">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </form>

                    <a href="{{ url('buy-now/'.$product->id) }}" class="btn btn-dark">
                        Buy Now
                    </a>

                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-link px-0">← Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- If you use Bootstrap Icons --}}

@endsection