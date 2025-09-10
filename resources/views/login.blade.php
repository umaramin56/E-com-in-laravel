@extends('master')
@section('content')

<style>
.login-wrap {
    min-height: calc(100vh - 140px);
    display: flex;
    align-items: center;
}

.login-card {
    border: 0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.12);
}

.login-card .card-header {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: #fff;
    font-weight: 700;
}
</style>

<div class="container login-wrap">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <div class="card login-card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection