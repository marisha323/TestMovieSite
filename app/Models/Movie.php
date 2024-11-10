<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable=[
        'status', 'title_uk', 'title_en', 'description_uk', 'description_en',
        'poster', 'youtube_trailer_id', 'release_year', 'view_start_date', 'view_end_date'    ];

    public function castMembers()
    {
        return$this->hasMany(CastMember::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'movie_tag');
    }
    public function getScreenshotsAttribute($value){
        return json_decode($value,true);
    }
    public function cast()
    {
        return $this->hasMany(CastMember::class);
    }

    public function images()
    {
        return $this->hasMany(Screenshot::class, 'movie_id');
    }

    public function director()
    {
        return $this->hasOne(CastMember::class)->where('type', 'director'); // Тільки режисер
    }
}

