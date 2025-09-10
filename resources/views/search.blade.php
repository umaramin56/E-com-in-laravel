@extends('master')
@section('content')

<style>
.search-wrap {
    padding: 30px 0 60px;
}

.search-title {
    font-weight: 700;
    font-size: 1.4rem;
    margin-bottom: 22px;
    border-left: 6px solid #0d6efd;
    padding-left: 10px;
}

.search-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

@media(max-width: 992px) {
    .search-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media(max-width: 768px) {
    .search-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 480px) {
    .search-grid {
        grid-template-columns: 1fr;
    }
}

.search-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
    transition: .25s ease all;
    background: #fff;
}

.search-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, .12);
}

.search-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    object-position: center;
}

.search-body {
    padding: 12px 14px;
}

.search-title-item {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 6px;
    color: #111;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.search-desc {
    font-size: .9rem;
    color: #6c757d;
    margin: 0 0 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.search-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>

<div class="container search-wrap">
    <h2 class="search-title">Search Results</h2>

    @if(count($products))
    <div class="search-grid">
        @foreach($products as $item)
        <div class="search-card">
            <a href="{{ url('detail/'.$item['id']) }}">
                <img src="{{ $item['gallery'] }}" alt="{{ $item['name'] }}" class="search-img">
            </a>
            <div class="search-body">
                <div class="search-title-item">{{ $item['name'] }}</div>
                <div class="search-desc">{{ \Illuminate\Support\Str::limit($item['description'], 80) }}</div>
                <div class="search-actions">
                    <span class="fw-bold text-primary">PKR {{ number_format($item['price'],0) }}</span>
                    <form action="{{ url('add_to_cart') }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                        <button type="submit" class="btn btn-sm btn-outline-dark">Add</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-muted">No products found.</p>
    @endif
</div>

@endsection