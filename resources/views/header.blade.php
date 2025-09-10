@php
    use Illuminate\Support\Facades\Session;
    use App\Http\Controllers\ProductController;

    $total = 0;
    if (Session::has('user')) {
        $total = ProductController::cartItem();
    }
    $user = Session::get('user');
    $userName = is_array($user)
        ? ($user['name'] ?? $user['email'] ?? 'Account')
        : ($user->name ?? $user->email ?? 'Account');
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">E-Com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/orders') }}">Orders</a></li>
      </ul>

      <div class="d-flex align-items-center gap-3">
        {{-- Search --}}
        <form class="d-flex" action="{{ url('/search') }}" method="GET" role="search">
          <input class="form-control me-2" type="search" name="q" placeholder="Search products...">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>

        {{-- Cart --}}
        <a href="{{ url('/cart') }}" class="btn btn-outline-dark position-relative">
          <i class="bi bi-cart3"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $total }}
          </span>
        </a>

        {{-- Auth --}}
        @if(Session::has('user'))
          <div class="dropdown">
            <a class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" href="#">
              {{ $userName }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
          </div>
        @else
          <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
        @endif
      </div>
    </div>
  </div>
</nav>

