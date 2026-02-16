<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'HealthAds') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --brand-700: #1f6f8b;
            --brand-800: #175a72;
            --surface-50: #f6fbff;
            --surface-100: #ecf6fd;
            --text-700: #1f2d3d;
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            background: radial-gradient(circle at 0% 0%, #f0f9ff 0%, #f6fbff 45%, #ffffff 100%);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-700);
        }
        .content {
            flex: 1 0 auto;
            padding: 2rem 0 2.5rem;
        }
        .footer {
            flex-shrink: 0;
            background: var(--brand-800);
            color: #dceef7;
            padding: 1.1rem 0;
            text-align: center;
            font-size: 0.95rem;
        }
        .navbar {
            background: linear-gradient(90deg, var(--brand-700) 0%, #2c7da0 100%);
            box-shadow: 0 8px 24px rgba(23, 90, 114, 0.2);
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: .2px;
        }
        .nav-link {
            border-radius: 999px;
            padding: .4rem .8rem !important;
            transition: background-color .2s ease, color .2s ease;
        }
        .nav-link:hover,
        .nav-link:focus {
            background: rgba(255,255,255,0.16);
        }
        .nav-link.active {
            background: rgba(255,255,255,0.24);
            font-weight: 600;
        }
        .nav-item .btn.btn-link.nav-link {
            text-decoration: none;
        }
        .card {
            border-radius: 16px;
            border: 1px solid #e5edf5;
            box-shadow: 0 10px 28px rgba(17, 52, 73, 0.08);
            overflow: hidden;
        }
        .card-header {
            background: #f8fcff;
            border-bottom: 1px solid #e6eef6;
            font-weight: 600;
        }
        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }
        .table thead th {
            font-weight: 600;
            color: #24445d;
            background: #f8fcff;
            border-bottom-width: 1px;
        }
        .form-control,
        .form-select {
            border-radius: 12px;
            border-color: #dce8f3;
            padding-top: .58rem;
            padding-bottom: .58rem;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #84b8d3;
            box-shadow: 0 0 0 .2rem rgba(44, 125, 160, 0.14);
        }
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: .5rem .9rem;
        }
        .btn-sm {
            border-radius: 8px;
        }
        .btn-primary {
            background: var(--brand-700);
            border-color: var(--brand-700);
        }
        .btn-primary:hover {
            background: var(--brand-800);
            border-color: var(--brand-800);
        }
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(16, 50, 75, 0.08);
        }
        .badge.bg-silver {
            background: #8ea1b5 !important;
        }
        .badge.bg-gold {
            background: #c79b2c !important;
        }
        .badge.bg-diamond {
            background: #4c82c5 !important;
        }
        .page-shell {
            background: linear-gradient(180deg, rgba(255,255,255,0.72) 0%, rgba(255,255,255,0.95) 100%);
            border: 1px solid #e4edf6;
            border-radius: 18px;
            box-shadow: 0 16px 32px rgba(21, 67, 95, 0.08);
            padding: 1.25rem;
        }
        @media (max-width: 767.98px) {
            .content {
                padding: 1.25rem 0 1.5rem;
            }
            .page-shell {
                border-radius: 14px;
                padding: .9rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><i class="fas fa-heartbeat"></i> HealthAds</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                        @if(!Auth::user()->is_admin)
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('packages.*') ? 'active' : '' }}" href="{{ route('packages.index') }}">Active Packages</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('mypackages') ? 'active' : '' }}" href="{{ route('mypackages') }}">My Packages</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('notifications') ? 'active' : '' }}" href="{{ route('notifications') }}">Notifications</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">Profile</a></li>
                        @if(Auth::user()->is_admin)
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="page-shell">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; {{ now()->year }} HealthAds. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>