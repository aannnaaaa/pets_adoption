<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $userId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if (Auth::id() == $userId) {
            return redirect()->back()->with('error', 'Вы не можете оставить отзыв самому себе.');
        }

        $existingReview = Review::where('reviewer_id', Auth::id())
            ->where('reviewed_user_id', $userId)
            ->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Вы уже оставляли отзыв этому пользователю.');
        }

        Review::create([
            'reviewer_id' => Auth::id(),
            'reviewed_user_id' => $userId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Отзыв успешно добавлен!');
    }
}
