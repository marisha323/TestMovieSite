<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Каталог фільмів</title>
    <!-- Підключення Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            color: #10654E;
            margin-bottom: 40px;
            text-align: center;
        }

        .btn-primary {
            background-color: #10654E;
            border-color: #10654E;
        }

        .btn-primary:hover {
            background-color: #0e4e42;
            border-color: #0e4e42;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .status {
            font-weight: bold;
            color: #10654E;
        }

        .btn-sm {
            font-size: 14px;
        }

        .pagination {
            justify-content: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Каталог фільмів</h1>

    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3">Додати новий фільм</a>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-primary mb-3">подивитись теги</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-4">
                <a href="{{ route('admin.movies.show', $movie->id) }}">
                    <div class="card">
                        <img style="height: auto"
                             src="{{ $movie->poster ? $movie->poster : 'https://via.placeholder.com/300x200' }}"
                             alt="Poster" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title_uk }}</h5>
                            <p class="card-text">Рік: {{ $movie->release_year }}</p>
                            <input type="checkbox" class="form-check-input" id="status_{{ $movie->id }}"
                                   {{ $movie->status ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="status_{{ $movie->id }}">
                                Статус: {{ $movie->status ? 'Показати' : 'Сховати' }}
                            </label>
                            <p class="status">{{ $movie->status ? 'Показати' : 'Сховати' }}</p>
                            <a href="{{ route('admin.cast-members.create-cast-members', $movie->id) }}"
                               class="btn btn-primary mb-3">Додати новий каст до фільму</a>
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Редагувати</a>
                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Пагінація -->
    <div class="pagination mt-3">
        {{ $movies->links() }}
    </div>
</div>

<!-- Підключення Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
