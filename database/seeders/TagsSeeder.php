<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Додавання тегів
        Tag::create([
            'name_uk' => 'Екшн',
            'name_en' => 'Action',
            'slug' => 'action'
        ]);

        Tag::create([
            'name_uk' => 'Комедія',
            'name_en' => 'Comedy',
            'slug' => 'comedy'
        ]);

        Tag::create([
            'name_uk' => 'Драма',
            'name_en' => 'Drama',
            'slug' => 'drama'
        ]);

        Tag::create([
            'name_uk' => 'Жахи',
            'name_en' => 'Horror',
            'slug' => 'horror'
        ]);
    }
}
