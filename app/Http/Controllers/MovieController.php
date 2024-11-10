<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Screenshot;
use App\Models\Tag;
use App\Services\MovieService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $movies = Movie::paginate(3); // Пагінація фільмів
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.movies.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title_uk' => 'required|string|max:225',
            'title_en' => 'required|string|max:255',
            'description_uk' => 'required|string',
            'description_en' => 'required|string',
            'poster' => 'required|image',
            'release_year' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'youtube_trailer_id' => 'nullable|string|max:255',
            'tags' => 'nullable|array', // Якщо теги є масивом
            'tags.*' => 'exists:tags,id', // Перевірка, чи існують ці теги в базі
            'status' => 'nullable|boolean',
            'screenshots' => 'array',  // Массив для скріншотів
            'screenshots.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Перевірка кожного файлу
        ]);
        $screenshot=Screenshot::findOrFail($screenshotImages->movie_id);

        $screenshots =[];
        foreach ($screenshotImages as $screenshotImage){
            $screenshot=Screenshot::findOrFail($screenshotImage->movie_id);
            $screenshots[]=$screenshot;
        }
        $this->movieService->createMovie($request->all());
        return redirect()->route('admin.movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::with(['cast','images'])->findOrFail($id);
        //$movie2 = Movie::with('images')->findOrFail($id);
        //dd($movie);
        return view('admin.movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $tags = Tag::all(); // Отримати всі теги з бази даних
        $screenshots = $movie->images; // Отримати всі скріншоти для цього фільму
        $movie->view_start_date = $movie->view_start_date ? Carbon::parse($movie->view_start_date) : null;
        $movie->view_end_date = $movie->view_end_date ? Carbon::parse($movie->view_end_date) : null;
        return view('admin.movies.edit', compact('movie', 'tags', 'screenshots'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Movie $movie, Request $request)
    {


        $request->validate([

            'title_uk' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_uk' => 'required|string',
            'description_en' => 'required|string',
            'poster' => 'nullable|image',
            'screenshots' => 'nullable|array', // Масив для скріншотів
            'screenshots.*' => 'image', // Кожен елемент має бути зображенням
            'release_year' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'youtube_trailer_id' => 'nullable|string|max:255',
            'tags' => 'nullable|array', // Якщо теги є масивом
            'tags.*' => 'exists:tags,id', // Перевірка, чи існують ці теги в базі
        ]);

        // Передача даних у сервіс
        $this->movieService->updateMovie($movie, $request->all(), $request->file('screenshots'));
        return redirect()->route('admin.movies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $this->movieService->deleteMovie($movie);
        return redirect()->route('admin.movies.index');
    }
}
