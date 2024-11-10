<?php

namespace App\Http\Controllers;

use App\Models\CastMember;
use App\Models\Movie;
use App\Services\CastMemberService;
use Illuminate\Http\Request;

class CastMemberController extends Controller
{
    protected $castMemberService;

    public function __construct(CastMemberService $castMemberService)
    {
        $this->castMemberService = $castMemberService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($movieId)
    {
        $movie = Movie::findOrFail($movieId); // Отримуємо конкретний фільм за ID
        return view('admin.cast-members.create-cast-members', compact('movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'type' => 'required|in:director,writer,actor,composer',
            'name_uk' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'photo' => 'nullable|image',
        ]);

        $castMember = $this->castMemberService->createCastMember($request);

        return redirect()->back()->with('success', 'Учасника касту успішно додано!');
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
    public function edit(string $id)
    {
        // Отримуємо члена касту по ID
        $castMember = CastMember::findOrFail($id);
        $movie=Movie::find($id);

        return view('admin.cast-members.edit-cast-members', compact('castMember','movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CastMember $castMember)
    {
        $request->validate([
            'type' => 'required|in:director,writer,actor,composer',
            'name_uk' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'photo' => 'nullable|image',
        ]);

        $this->castMemberService->updateCastMember($request, $castMember);

        return redirect()->route('admin.movies.show', $castMember->movie->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CastMember $castMember)
    {
        $movieId = $castMember->movie->id;
        $this->castMemberService->deleteCastMember($castMember);

        return redirect()->route('admin.movies.show', $movieId);
    }
}
