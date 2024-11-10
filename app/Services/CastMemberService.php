<?php

namespace App\Services;

use App\Models\CastMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CastMemberService
{
    public function createCastMember(Request $request){
        $data=$request->only(['movie_id', 'type', 'name_uk', 'name_en']);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photoPath = $request->file('photo')->store('cast_photos', 'public');
            $data['photo'] = url(Storage::url($photoPath));  // Зберігаємо URL фото
        } else {
            $data['photo'] = null;
        }

        return CastMember::create($data);

    }

    public function updateCastMember(Request $request, CastMember $castMember)
    {
        $data = $request->only(['type', 'name_uk', 'name_en']);

        // Перевірка наявності нового фото та його дійсності
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Видаляємо старе фото, якщо воно існує
            if ($castMember->photo) {
                Storage::disk('public')->delete($castMember->photo);
            }

            // Зберігаємо нове фото та отримуємо його URL
            $photoPath = $request->file('photo')->store('cast_photos', 'public');
            $data['photo'] = url(Storage::url($photoPath));
        }

        $castMember->update($data);

        return $castMember;
    }


    public function deleteCastMember(CastMember $castMember)
    {
        // Видалення фото, якщо воно існує
        if ($castMember->photo) {
            Storage::disk('public')->delete($castMember->photo);
        }

        $castMember->delete();
        return true;
    }
}
