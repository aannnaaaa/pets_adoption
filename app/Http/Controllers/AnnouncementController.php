<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 2;
        return view('announcements.index', [
            'announcements' => Announcement::paginate($perpage)->withQueryString()
        ]);
    }

    public function show(string $id)
    {
        return view('announcements.show', [
            'announcement' => Announcement::all()->where('id', '=', $id)->first()
        ]);
    }

    public function create()
    {
        return view('announcements.create', [
            'users' => User::whereIn('role', ['owner', 'shelter'])->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'integer',
            'title' => 'required|max:255',
            'species' => 'required|max:100',
            'breed' => 'max:255',
            'age_min' => 'integer',
            'age_max' => 'integer',
            'sex' => 'required',
            'count' => 'integer',
            'description' => '',
            'price' => 'required|integer',
            'location_city' => 'required|max:100',
            'main_photo' => 'max:512',
            'status' => 'required'
        ]);

        $announcement = new Announcement($validated);
        $announcement->save();
        return redirect(to: '/announcements');
    }

    public function edit(string $id)
    {
        $announcement = Announcement::all()->where('id', $id)->first();

        if (! Gate::allows( 'update-announcement', $announcement)) {
            return redirect( '/error')->with('message',
                'У вас нет разрешения на редактирование объявления ' . $id);
        }

        return view('announcements.edit', [
            'announcement' => $announcement,
            'users' => User::whereIn('role', ['owner', 'shelter'])->get()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'species' => 'required|max:100',
            'breed' => 'max:255',
            'age_min' => 'integer',
            'age_max' => 'integer',
            'sex' => 'required',
            'count' => 'integer',
            'description' => '',
            'price' => 'required|integer',
            'location_city' => 'required|max:100',
            'main_photo' => 'max:512',
            'status' => 'required'
        ]);

        $announcement = Announcement::all()->where('id', $id)->first();
        $announcement->title = $validated['title'];
        $announcement->species = $validated['species'];
        $announcement->breed = $validated['breed'];
        $announcement->age_min = $validated['age_min'];
        $announcement->age_max = $validated['age_max'];
        $announcement->sex = $validated['sex'];
        $announcement->count = $validated['count'];
        $announcement->description = $validated['description'];
        $announcement->price = $validated['price'];
        $announcement->location_city = $validated['location_city'];
        $announcement->main_photo = $validated['main_photo'];
        $announcement->status = $validated['status'];
        $announcement->save();
        return redirect(to: '/announcements');
    }

    public function destroy(string $id)
    {
        if (! Gate::allows( 'destroy-announcement', Announcement::all()->where( 'id', $id)->first())) {
            return redirect( '/error')->with('message',
                'У вас нет разрешения на удаление объявления ' . $id);
        }

        Announcement::destroy($id);
        return view('announcements.success', [
            'message' => 'Объявление #' . $id . ' успешно удалено!'
        ]);
    }
}
