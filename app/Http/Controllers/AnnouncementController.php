<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 12;
        return view('announcements.index', [
            'announcements' => Announcement::paginate($perpage)->withQueryString()
        ]);
    }

    public function show(string $id)
    {
        return view('announcements.show', [
            'announcement' => Announcement::with('owner')->findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|integer|exists:users,id',
            'title' => 'required|max:255',
            'species' => 'required|max:100',
            'breed' => 'nullable|max:255',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
            'sex' => 'required',
            'count' => 'nullable|integer',
            'description' => 'nullable',
            'price' => 'required|integer',
            'location_city' => 'required|max:100',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Изменено на файл
            'status' => 'required'
        ]);

        // Обработка загрузки фото
        if ($request->hasFile('main_photo')) {
            $validated['main_photo'] = $request->file('main_photo')->store('announcements', 'public');
        }

        $announcement = Announcement::create($validated);

        return redirect('/announcements')
            ->with('success', 'Объявление успешно создано!');
    }

    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        if (!Gate::allows('update-announcement', $announcement)) {
            return redirect('/error')->with('message',
                'У вас нет разрешения на редактирование объявления #' . $id);
        }

        return view('announcements.edit', [
            'announcement' => $announcement
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'species' => 'required|max:100',
            'breed' => 'nullable|max:255',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
            'sex' => 'required',
            'count' => 'nullable|integer',
            'description' => 'nullable',
            'price' => 'required|integer',
            'location_city' => 'required|max:100',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Изменено на файл
            'status' => 'required'
        ]);

        $announcement = Announcement::findOrFail($id);

        if ($request->hasFile('main_photo')) {
            if ($announcement->main_photo) {
                Storage::disk('public')->delete($announcement->main_photo);
            }
            $validated['main_photo'] = $request->file('main_photo')->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect('/announcements')
            ->with('success', 'Объявление успешно обновлено!');
    }

    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        if (!Gate::allows('destroy-announcement', $announcement)) {
            return redirect('/error')->with('message',
                'У вас нет разрешения на удаление объявления #' . $id);
        }

        if ($announcement->main_photo) {
            Storage::disk('public')->delete($announcement->main_photo);
        }

        $announcement->delete();

        return redirect('/announcements')
            ->with('success', 'Объявление #' . $id . ' успешно удалено!');
    }
}
