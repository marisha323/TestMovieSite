<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->title_uk }} - Деталі</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .movie-poster {
            max-height: 400px;
            object-fit: cover;
        }
        .cast-member-photo {
            max-width: 80px;
            border-radius: 50%;
        }
        .movie-info {
            margin-bottom: 20px;
        }
        .movie-info h1 {
            font-size: 2.5rem;
        }
        .movie-info p {
            font-size: 1.2rem;
        }
        .cast-list {
            margin-top: 20px;
        }
        .cast-list li {
            margin-bottom: 10px;
        }
        .btn-custom {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="movie-info">
        <h1>{{ $movie->title_uk }} ({{ $movie->release_year }})</h1>
        <img src="{{ $movie->poster }}" alt="Poster" class="img-fluid movie-poster mb-4">
        <p><strong>Теги:</strong></p>
        <ul>
            @foreach($movie->tags as $tag)
                <li>{{ $tag->name_uk }}</li>
            @endforeach
        </ul>
        <p><strong>Опис:</strong> {{ $movie->description_uk }}</p>

        <p><strong>Рік випуску:</strong> {{ $movie->release_year }}</p>
        <p><strong>Дата початку перегляду:</strong> {{ \Carbon\Carbon::parse($movie->view_start_date)->format('d.m.Y H:i') }}</p>
        <p><strong>Дата кінця перегляду:</strong> {{ \Carbon\Carbon::parse($movie->view_end_date)->format('d.m.Y H:i') }}</p>

        <p><strong>Скріншоти:</strong></p>
        <div class="container mt-4">
            <h2>Галерея зображень для фільму: {{ $movie->title_uk }}</h2>
            <div class="row">
                @foreach($movie->images as $image)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{$image->image_path }}" class="card-img-top" alt="Image for {{ $movie->title_uk }}">
                            <div class="card-body">
                                <p class="card-text">Опис зображення для фільму: {{ $movie->title_uk }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>


    <h3 class="mt-5">Каст</h3>
    <ul class="list-group cast-list">
        @foreach($movie->cast as $castMember)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ ucfirst($castMember->type) }}</strong>: {{ $castMember->name_uk }}
                    @if($castMember->photo)
                        <img src="{{ $castMember->photo }}" alt="{{ $castMember->name_uk }}" class="cast-member-photo ms-2">
                    @endif
                </div>
                <div class="d-flex">
                    <a href="{{ route('admin.cast-members.edit',  $castMember->id) }}" class="btn btn-warning btn-sm me-2">Редагувати</a>

                    <form action="{{ route('admin.cast-members.destroy', $castMember->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary btn-custom">Назад до списку фільмів</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
