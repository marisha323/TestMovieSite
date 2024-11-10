<?php

use App\Http\Controllers\CastMemberController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [ClientController::class, 'index'])->name('welcome');
Route::get('movie/{id}', [ClientController::class, 'show'])->name('show');
//Route::get('/locale/{locale}', [ClientController::class, 'switch'])->name('locale.switch');
Route::get('/locale/{locale}', function ($locale) {
    // Список підтримуваних мов
    $supportedLocales = ['en', 'uk'];

    // Якщо локаль передана і вона є в списку підтримуваних мов
    if (in_array($locale, $supportedLocales)) {
        // Зберігаємо локаль у сесії
        session(['locale' => $locale]);

        // Встановлюємо локаль додатку
        app()->setLocale($locale);
    } elseif (session('locale')) {
        // Якщо локаль є в сесії, встановлюємо її
        app()->setLocale(session('locale'));
    }

    // Повертаємо користувача на попередню сторінку
    return redirect()->back();
})->name('locale.switch');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('movies/create', [MovieController::class, 'create'])->name('admin.movies.create');
// Зберігання нового фільму
Route::post('movies', [MovieController::class, 'store'])->name('admin.movies.store');
// Сторінка редагування фільму
Route::get('movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movies.edit');

// Оновлення фільму
Route::put('movies/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');

// Видалення фільму
Route::delete('movies/{movie}', [MovieController::class, 'destroy'])->name('admin.movies.destroy');

// Показати список фільмів
Route::get('movies', [MovieController::class, 'index'])->name('admin.movies.index');

Route::get('movie/show/{id}', [MovieController::class, 'show'])->name('admin.movies.show');

Route::prefix('cast-members')->name('admin.cast-members.')->group(function () {
    Route::get('create/{movie}', [CastMemberController::class, 'create'])->name('create-cast-members'); // Форма для створення нового касту
    Route::post('store', [CastMemberController::class, 'store'])->name('store'); // Збереження нового касту
    Route::get('cast-members/{id}/edit', [CastMemberController::class, 'edit'])->name('edit');
    Route::put('{castMember}', [CastMemberController::class, 'update'])->name('update'); // Оновлення існуючого касту
    Route::delete('{castMember}', [CastMemberController::class, 'destroy'])->name('destroy'); // Видалення касту
});

Route::prefix('admin')->name('admin.tags.')->group(function () {
    Route::get('/tags', [TagController::class, 'index'])->name('index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('create');
    Route::post('/tags', [TagController::class, 'store'])->name('store');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('destroy');
});

Route::get('locale/{locale}', function ($locale) {
    // Перевіряємо, чи мова доступна
    if (in_array($locale, ['uk', 'en'])) {
        session(['locale' => $locale]); // Зберігаємо вибір мови в сесії
        App::setLocale($locale); // Встановлюємо локаль
    }
    return redirect()->back(); // Переходимо назад на попередню сторінку
})->name('locale.switch');
require __DIR__.'/auth.php';
