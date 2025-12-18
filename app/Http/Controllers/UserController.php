<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        return $this->show($user->id);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $announcements = $user->announcements()
            ->orderBy('created_at', 'desc')
            ->get();

        $reviews = Review::where('reviewed_user_id', $id)
            ->with('reviewer')
            ->orderBy('created_at', 'desc')
            ->get();

        $avgRating = DB::table('reviews')
            ->where('reviewed_user_id', $id)
            ->avg('rating') ?? 0;

        $reviewsCount = $reviews->count();

        return view('users.profile', [
            'user' => $user,
            'announcements' => $announcements,
            'reviews' => $reviews,
            'avgRating' => $avgRating,
            'reviewsCount' => $reviewsCount
        ]);
    }
}
