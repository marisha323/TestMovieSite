<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .logo{
        width: 60px;
        height: 60px;
    }
    </style>
</head>
<body class="antialiased">

@if (Route::has('login'))

    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex items-center">

        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-4">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-4">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 m-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-4">Register</a>
            @endif
        @endauth


    </div>
@endif
{{ App::getLocale() }}
<div class="container">
    <!-- Логотип і перемикач мови -->
    <div class="d-flex justify-content-between mb-4">
        <div>
            <img src="{{ asset('http://127.0.0.1:8000/storage/logo/logo.png') }}" alt="Logo" class="logo">
        </div>
        <div>
            <!-- Перемикач мови (можна зробити за допомогою кнопок або вибору) -->
            <a onclick="changeLocale('uk')" href="{{ route('locale.switch', ['locale' => 'uk']) }}" class="btn btn-secondary">UA</a>
            <a onclick="changeLocale('en')" href="{{ route('locale.switch', ['locale' => 'en']) }}" class="btn btn-secondary">EN</a>
        </div>
    </div>
    <h1>{{ __('messages.films') }}</h1>

    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-md-4 mb-4">
                <a href="{{ route('show', $movie->id) }}">
                    <div class="card">
                        <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text"><strong>{{ __('messages.release_year') }}:</strong> {{ $movie->release_year }}</p>
                            <p class="card-text">{{ $movie->description }}</p>
                            @if ($movie->director)
                                <p><strong>{{ __('messages.director') }}:</strong> {{ $movie->director->{'name_' . $locale} }}</p>
                            @else
                                <p><strong>{{ __('messages.director') }}:</strong> {{ __('messages.not_available') }}</p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <!-- Пагінація -->
    <div class="d-flex justify-content-center mt-4">
        <div class="pagination">
            {{ $movies->appends(['locale' => app()->getLocale()])->links() }}
        </div>
    </div>
</div>

<script>
    function changeLocale(locale) {
        // Отримуємо поточний URL
        const currentUrl = new URL(window.location.href);

        // Оновлюємо параметр locale в URL
        currentUrl.searchParams.set('locale', locale);

        // Оновлюємо URL без перезавантаження сторінки
        window.history.pushState({}, '', currentUrl);

        // Надсилаємо запит на сервер для оновлення мови
        window.location.reload();
    }
</script>
</body>
</html>
