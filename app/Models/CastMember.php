<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CastMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id', 'type', 'name_uk', 'name_en', 'photo'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

}
