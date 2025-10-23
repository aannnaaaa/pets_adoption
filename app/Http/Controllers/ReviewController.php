<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function showReceived($id)
    {
        $user = User::with('reviewsReceived')->findOrFail($id);

        $avgRating = DB::table('reviews')
            ->where('reviewed_user_id', $id)
            ->selectRaw('AVG(rating) as average')
            ->first();

        return view('reviews.received', compact('user', 'avgRating'));
    }

    public function showGiven($id)
    {
        $user = User::with('reviewsGiven')->findOrFail($id);

        $totalReviews = DB::table('reviews')
            ->where('reviewer_id', $id)
            ->count();

        return view('reviews.given', compact('user', 'totalReviews'));
    }
}
