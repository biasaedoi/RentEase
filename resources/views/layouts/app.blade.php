<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentEase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">RentEase</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item me-2">
                                <a href="{{ route('admin.rentals.index') }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-speedometer2"></i> Admin Dashboard
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login.show') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register.show') }}" class="btn btn-outline-success btn-sm">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
