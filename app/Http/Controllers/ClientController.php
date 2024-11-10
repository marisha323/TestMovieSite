<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locale = session('locale', 'uk'); // використовуємо сесію для мови або 'uk' за замовчуванням

        $movies = Movie::select(
            'id',
            'poster',
            "title_{$locale} as title",
            'release_year',
            "description_{$locale} as description"
        )->paginate(3);

        return view('welcome', compact('movies', 'locale'));
    }
    public function switch($locale, Request $request)
    {

        // Перевіряємо, чи мова існує в доступних мовах
        if (in_array($locale, ['uk', 'en'])) {
            session(['locale' => $locale]); // Зберігаємо мову в сесії
        }
        return redirect()->back(); // Повертаємо на попередню сторінку
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with('cast','images')->findOrFail($id); // Отримуємо фільм з усіма кастами (режисер, сценарист тощо)

        // Перевірка статусу фільму
        if ($movie->status == 0) {
            abort(404); // Якщо фільм схований, повертаємо 404
        }

        // Перевірка на вікна перегляду
        $currentDate = Carbon::now();
        if ($currentDate < Carbon::parse($movie->view_start_date) || $currentDate > Carbon::parse($movie->view_end_date)) {
            $movie->youtube_trailer_id = null; // Якщо не в періоді перегляду, не показуємо відео
        }

        return view('show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
