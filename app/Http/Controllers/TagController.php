<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_uk' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $this->tagService->createTag($request->all());
        return redirect()->route('admin.tags.index')->with('success', 'Тег створено успішно');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name_uk' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $this->tagService->updateTag($tag, $request->all());
        return redirect()->route('admin.tags.index')->with('success', 'Тег оновлено успішно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->tagService->deleteTag($tag);
        return redirect()->route('admin.tags.index')->with('success', 'Тег видалено успішно');
    }
}
