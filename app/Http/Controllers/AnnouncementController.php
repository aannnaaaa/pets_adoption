<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
class AnnouncementController extends Controller
{
    public function index()
    {
        return view('announcements.index',[
            'announcements' => Announcement::all()
        ]);
    }
    public function show(string $id)
    {
        return view('announcements.show',[
            'announcement' => Announcement::all()->where('id', '=', $id)->first()
        ]);
    }
}
