<?php

namespace App\Services;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagService
{

    public function getAllTags()
    {
        return Tag::all();
    }
    public function createTag(array $data)
    {
        $data['slug'] = Str::slug($data['name_en']);
        return Tag::create($data);
    }

    public function updateTag(Tag $tag, array $data)
    {
        $data['slug'] = Str::slug($data['name_en']);
        $tag->update($data);
        return $tag;
    }

    public function deleteTag(Tag $tag)
    {
        return $tag->delete();
    }
}
