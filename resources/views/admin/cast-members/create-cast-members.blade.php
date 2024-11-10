<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Додати новий каст до фільму</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #10654E;
            margin-bottom: 20px;
        }
        .btn-success {
            background-color: #10654E;
            border-color: #10654E;
        }
        .btn-success:hover {
            background-color: #0e4e42;
            border-color: #0e4e42;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Назад до фільмів</a>
    <div class="form-container">
        <h3>Додати новий каст до фільму</h3>

        <form action="{{ route('admin.cast-members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">

            <div class="mb-3">
                <label for="type" class="form-label">Тип</label>
                <select name="type" class="form-control" required>
                    <option value="director">Режисер</option>
                    <option value="writer">Сценарист</option>
                    <option value="actor">Актор</option>
                    <option value="composer">Композитор</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="name_uk" class="form-label">Ім'я (укр.)</label>
                <input type="text" name="name_uk" id="name_uk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="name_en" class="form-label">Ім'я (англ.)</label>
                <input type="text" name="name_en" id="name_en" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Фото</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-3">Додати</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
