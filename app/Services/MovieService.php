<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    public function createMovie($data){

        // Перевірка і збереження постера
        if (isset($data['poster']) && $data['poster']->isValid()) {
            $posterPath = $data['poster']->store('posters', 'public');
            $posterUrl = url(Storage::url($posterPath));
           //dd(Storage::url('1'),$posterPath,$posterUrl);
        } else {
            $posterUrl = null;
        }

        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        // Створення фільму
        $movie = Movie::create([
            'title_uk' => $data['title_uk'],
            'title_en' => $data['title_en'],
            'description_uk' => $data['description_uk'],
            'description_en' => $data['description_en'],
            'release_year' => $data['release_year'],
            'view_start_date' => $startDate,
            'view_end_date' => $endDate,
            'status' => $data['status'] ?? true,
            'youtube_trailer_id' => $data['youtube_trailer_id'],
            'poster' => $posterUrl,
        ]);

        // Оновлення тегів
        if (isset($data['tags'])) {
            $movie->tags()->sync($data['tags']);
        }

        // Збереження скріншотів
        if (isset($data['screenshots'])) {
            foreach ($data['screenshots'] as $screenshot) {
                if ($screenshot->isValid()) {
                    $screenshotPath = $screenshot->store('screenshots', 'public');
                    $movie->screenshots()->create([
                        'image_path' => url(Storage::url($screenshotPath)),
                    ]);
                }
            }
        }

        return $movie;
    }


    public function updateMovie(Movie $movie,$data, $screenshots){

        if (isset($data['poster']) && $data['poster']->isValid()) {
            $posterPath = $data['poster']->store('posters', 'public');
            $posterUrl = Storage::url($posterPath);
            $movie->poster = $posterUrl;
        }
        $status = isset($data['status']) && $data['status'] === 'on' ? true : false;


        // Оновлення фільму
        $movie->update([
            'title_uk' => $data['title_uk'],
            'title_en' => $data['title_en'],
            'description_uk' => $data['description_uk'],
            'description_en' => $data['description_en'],
            'release_year' => $data['release_year'],
            'view_start_date' => $data['start_date'],
            'view_end_date' => $data['end_date'],
            'status' => $status,
            'youtube_trailer_id' => $data['youtube_trailer_id'],
        ]);

        // Оновлення тегів
        if (isset($data['tags'])) {
            $movie->tags()->sync($data['tags']);
        }
        // Обробка скріншотів
        if ($screenshots) {
            foreach ($screenshots as $screenshot) {
                if ($screenshot->isValid()) {
                    $screenshotPath = $screenshot->store('screenshots', 'public');
                    $screenshotUrl = Storage::url($screenshotPath);

                    // Збереження нового скріншоту в таблиці images
                    $movie->images()->create([
                        'image_path' => $screenshotUrl,
                    ]);
                }
            }
        }
        return $movie;
    }

    public function deleteMovie(Movie $movie){
        if ($movie->poster){
            Storage::delete($movie->poster);
        }
        $movie->delete();
        return true;
    }
}
