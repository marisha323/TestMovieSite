<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редагування члена касту</title>
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
        h1 {
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
<div class="container">
    <a href="{{ route('admin.movies.show', $movie->id) }}" class="btn btn-secondary">Назад до списку кастів</a>
    <div class="form-container mt-4">
        <h1>Редагувати члена касту</h1>

        <form action="{{ route('admin.cast-members.update', $castMember->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Тип</label>
                <select name="type" class="form-select" required>
                    <option value="director" {{ $castMember->type == 'director' ? 'selected' : '' }}>Режисер</option>
                    <option value="writer" {{ $castMember->type == 'writer' ? 'selected' : '' }}>Сценарист</option>
                    <option value="actor" {{ $castMember->type == 'actor' ? 'selected' : '' }}>Актор</option>
                    <option value="composer" {{ $castMember->type == 'composer' ? 'selected' : '' }}>Композитор</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="name_uk" class="form-label">Ім'я (Українською)</label>
                <input type="text" name="name_uk" id="name_uk" class="form-control" value="{{ $castMember->name_uk }}" required>
            </div>

            <div class="mb-3">
                <label for="name_en" class="form-label">Ім'я (Англійською)</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $castMember->name_en }}" required>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Фото</label>
                <input type="file" name="photo" id="photo" class="form-control">
                @if($castMember->photo)
                    <img src="{{ $castMember->photo }}" alt="Поточне фото" width="100" class="mt-2">
                @endif
            </div>



            <button type="submit" class="btn btn-success mt-3">Оновити члена касту</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
