<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Movie</title>
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
    <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Назад до фільмів</a>
    <div class="form-container">
        <h1>Додати новий фільм</h1>

        <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title_uk" class="form-label">Назва (Українською)</label>
                <input type="text" name="title_uk" id="title_uk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="title_en" class="form-label">Назва (Англійською)</label>
                <input type="text" name="title_en" id="title_en" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description_uk" class="form-label">Опис (Українською)</label>
                <textarea name="description_uk" id="description_uk" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="description_en" class="form-label">Опис (Англійською)</label>
                <textarea name="description_en" id="description_en" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="poster" class="form-label">Постер</label>
                <input type="file" name="poster" id="poster" class="form-control" required>
            </div>

            <div id="screenshotFields">
                <div class="screenshot-input">
                    <label for="screenshots" class="form-label">Скріншот</label>
                    <input type="file" name="screenshots[]" class="form-control">
                </div>
            </div>
            <button type="button" id="addScreenshot" class="btn btn-secondary mt-2">Додати ще скріншот</button>

            <div class="mb-3">
                <label for="release_year" class="form-label">Рік випуску</label>
                <input type="number" name="release_year" id="release_year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Дата початку перегляду</label>
                <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Дата кінця перегляду</label>
                <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="youtube_trailer_id" class="form-label">ID трейлера на YouTube</label>
                <input type="text" name="youtube_trailer_id" id="youtube_trailer_id" class="form-control">
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Теги</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">
                            УКР - {{ $tag->name_uk }} :: ENG - {{ $tag->name_en }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Зберегти фільм</button>
        </form>
    </div>
</div>

<!-- Підключення Bootstrap JS (для кращої роботи з формами) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('addScreenshot').addEventListener('click', function() {
        let newScreenshotInput = document.createElement('div');
        newScreenshotInput.classList.add('screenshot-input');
        newScreenshotInput.innerHTML = `
            <label for="screenshots" class="form-label">Скріншот</label>
            <input type="file" name="screenshots[]" class="form-control">
        `;
        document.getElementById('screenshotFields').appendChild(newScreenshotInput);
    });
</script>
</body>
</html>
