<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Додати новий тег</title>
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
<div class="container mt-4">
    <div class="form-container">
        <h1>Додати новий тег</h1>
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name_uk" class="form-label">Назва (Українською)</label>
                <input type="text" name="name_uk" id="name_uk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="name_en" class="form-label">Назва (Англійською)</label>
                <input type="text" name="name_en" id="name_en" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Зберегти тег</button>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary ms-2">Назад до списку тегів</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
