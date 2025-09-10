@extends('master')
@section('content')

{{-- Page-specific styles --}}
<style>
/* ===== Carousel ===== */
.hero-carousel .carousel-item img {
    height: 420px;
    object-fit: cover;
    object-position: center;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.hero-carousel .carousel-caption {
    bottom: 22%;
}

.hero-carousel .caption-box {
    background: rgba(0, 0, 0, .55);
    backdrop-filter: blur(2px);
    padding: 14px 18px;
    border-radius: 12px;
    display: inline-block;
}

.hero-carousel h3 {
    margin: 0 0 6px;
    font-weight: 700;
}

.hero-carousel p {
    margin: 0;
}

/* ===== Sections & spacing ===== */
.page-wrap {
    padding-top: 18px;
    padding-bottom: 60px;
}

.section-title {
    font-weight: 700;
    font-size: 1.5rem;
    margin: 28px 0 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title::before {
    content: "";
    width: 6px;
    height: 24px;
    background: #0d6efd;
    border-radius: 4px;
}

/* ===== Trending grid ===== */
.trend-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

@media (max-width: 992px) {
    .trend-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .trend-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .trend-grid {
        grid-template-columns: 1fr;
    }
}

.trend-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    transition: transform .25s ease, box-shadow .25s ease;
    background: #fff;
}

.trend-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
}

.trend-img {
    width: 100%;
    height: 210px;
    object-fit: cover;
    object-position: center;
    display: block;
}

.trend-body {
    padding: 12px 14px;
}

.trend-title {
    font-size: 1rem;
    font-weight: 600;
    margin: 0 0 6px;
    color: #111;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.trend-desc {
    color: #6c757d;
    font-size: .9rem;
    margin: 0 0 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.trend-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>

<div class="container page-wrap">

    {{-- ===== HERO CAROUSEL ===== --}}
    <div id="carouselExampleCaptions" class="carousel slide hero-carousel" data-bs-ride="carousel">

        {{-- Indicators (dynamic) --}}
        <div class="carousel-indicators">
            @foreach($products as $item)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}"
                class="{{ $loop->first ? 'active' : '' }}" @if($loop->first) aria-current="true" @endif
                aria-label="Slide {{ $loop->iteration }}"></button>
            @endforeach
        </div>

        {{-- Slides (dynamic) --}}
        <div class="carousel-inner">
            @foreach($products as $item)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <a href="detail/{{$item['id']}}">
                    <img src="{{ $item['gallery'] }}" class="d-block w-100" alt="{{ $item['name'] }}">
                    <div class="carousel-caption d-block">
                        <div class="caption-box">
                            <h3 class="text-white">{{ $item['name'] }}</h3>
                            <p class="text-light mb-0">{{ \Illuminate\Support\Str::limit($item['description'], 120) }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        {{-- Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- ===== TRENDING PRODUCTS ===== --}}
    <h2 class="section-title">Trending Products</h2>

    <div class="trend-grid">
        @foreach($products as $item)
        <div class="trend-card">
            <img src="{{ $item['gallery'] }}" alt="{{ $item['name'] }}" class="trend-img">
            <div class="trend-body">
                <div class="trend-title">{{ $item['name'] }}</div>
                <div class="trend-desc">{{ \Illuminate\Support\Str::limit($item['description'], 90) }}</div>
                <div class="trend-actions">
                    <a href="{{ url('detail/'.$item['id']) }}" class="btn btn-sm btn-primary">View</a>
                    <form action="{{ url('add_to_cart') }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection