<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insurance</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('cars.index') }}">Insurance</a>

        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cars.index') }}">{{ __('cars.cars') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('owners.index') }}">{{ __('cars.owner') }}</a>
                    </li>
                @endauth
            </ul>
            <!-- Language Switcher -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="language/kk" class="nav-link btn btn-sm btn-info">
                        {{ __('cars.switch_to_kazakh') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="language/en" class="nav-link btn btn-sm btn-info">
                        {{ __('cars.switch_to_english') }}
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <span class="nav-link">{{ auth()->user()->name }} ({{ auth()->user()->type }})</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="display:inline; border:none; background:none;">
                                {{ __('cars.logout') }}
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
