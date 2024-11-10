<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->title_uk }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .movie-detail {
            margin-top: 20px;
        }

        .movie-poster {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
            height: auto;
            overflow: hidden; /* Щоб вміст не виходив за межі картки */
        }

        .card-img-top {
            margin-bottom: 10px;
            border-radius: 8px 8px 0 0;
            width: 100%; /* Зображення має займати всю ширину картки */
            max-height: 300px; /* Максимальна висота */
            object-fit: cover; /* Зображення не буде спотворюватись, якщо воно не співпадає з пропорціями */
        }
        .card-body {
            background-color: #f9f9f9;
        }

        .youtube-trailer iframe {
            border-radius: 8px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #10654E;
        }

        h3 {
            font-size: 1.8rem;
            margin-top: 20px;
        }

        p {
            font-size: 1rem;
            line-height: 1.5;
        }

        .cast-photo {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .tag-list {
            list-style: none;
            padding-left: 0;
        }

        .tag-list li {
            display: inline-block;
            background-color: #10654E;
            color: white;
            padding: 5px 15px;
            margin-right: 10px;
            border-radius: 20px;
            font-size: 1rem;
        }

        .screenshot-gallery img {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .screenshot-gallery .card-body {
            background-color: #f8f9fa;
        }

        /* Стилі для лівої та правої частини */
        .left-column {
            max-width: 60%;
            padding-right: 30px;
        }

        .right-column {
            max-width: 40%;
        }

        .row-custom {
            display: flex;
            justify-content: space-between;
        }

        .screenshot-gallery .col-md-4 {
            margin-bottom: 20px;
        }

         .logo{
             width: 60px;
             height: 60px;
         }

    </style>
</head>
<body>

<div class="container movie-detail">
    <!-- Логотип і перемикач мови -->
    <div class="d-flex justify-content-between mb-4">
        <div>
            <img src="{{ asset('http://127.0.0.1:8000/storage/logo/logo.png') }}" alt="Logo" class="logo">
        </div>
        <div>
            <!-- Перемикач мови (можна зробити за допомогою кнопок або вибору) -->
            <a href="{{ route('locale.switch', ['locale' => 'uk']) }}" class="btn btn-secondary">UA</a>
            <a href="{{ route('locale.switch', ['locale' => 'en']) }}" class="btn btn-secondary">EN</a>
        </div>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-secondary">Назад до фільмів</a>
    <h1>{{ $movie->{'title_' . app()->getLocale()} }} ({{ $movie->release_year }})</h1>
    <img src="{{ $movie->poster }}" alt="Poster" class="img-fluid movie-poster mb-4">

    <!-- Tags Section -->
    <p><strong>{{ __('messages.tags') }}:</strong></p>
    <ul class="tag-list">
        @foreach($movie->tags as $tag)
            <li>{{ $tag->{'name_' . app()->getLocale()} }}</li>
        @endforeach
    </ul>

    <!-- Description Section -->
    <p><strong>{{ __('messages.description') }}:</strong> {{ $movie->{'description_' . app()->getLocale()} }}</p>
    <p><strong>{{ __('messages.release Year') }}:</strong> {{ $movie->release_year }}</p>
    <p><strong>{{ __('messages.view Start Date') }}:</strong> {{ \Carbon\Carbon::parse($movie->view_start_date)->format('d.m.Y H:i') }}</p>
    <p><strong>{{ __('messages.view End Date') }}:</strong> {{ \Carbon\Carbon::parse($movie->view_end_date)->format('d.m.Y H:i') }}</p>

    <!-- Cast Section -->
    <h3>{{ __('messages.cast') }}:</h3>
    <ul class="list-unstyled">
        @foreach($movie->cast as $cast)
            <li>
                <strong>{{ ucfirst($cast->type) }}:</strong> {{ $cast->{'name_' . app()->getLocale()} }}<br>
                @if($cast->photo)
                    <img src="{{ $cast->photo }}" alt="{{ $cast->{'name_' . app()->getLocale()} }}" class="cast-photo">
                @endif
            </li>
        @endforeach
    </ul>

    <div class="row row-custom">
        <!-- Left Column - Gallery Section -->
        <div class="col-md-6 left-column">
            <h3>{{ __('messages.screenshots') }}:</h3>
            <div class="container screenshot-gallery">
                <h2>{{ __('messages.gallery for movie') }}: {{ $movie->{'title_' . app()->getLocale()} }}</h2>
                <div class="row">
                    @foreach($movie->images as $image)
                        <div class="col-md-12 mb-7">
                            <div class="card">
                                <img src="{{ $image->image_path }}" class="card-img-top" alt="{{ __('Image for') }} {{ $movie->{'title_' . app()->getLocale()} }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column - YouTube Trailer Section -->
        <div class="col-md-5 right-column">
            @if($movie->youtube_trailer_id)
                <h3>{{ __('messages.trailer') }}:</h3>
                <div class="youtube-trailer">
                    <iframe width="600px" height="400px" src="https://www.youtube.com/embed/{{ $movie->youtube_trailer_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            @else
                <p>{{ __('messages.trailer not available.') }}</p>
            @endif
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
