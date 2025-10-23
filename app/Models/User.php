<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'city', 'last_login'
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'owner_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function reviewsGiven()
    {
        return $this->belongsToMany(
            User::class,
            'reviews',
            'reviewer_id',
            'reviewed_user_id'
        )->withPivot('rating', 'comment', 'created_at');
    }

    public function reviewsReceived()
    {
        return $this->belongsToMany(
            User::class,
            'reviews',
            'reviewed_user_id',
            'reviewer_id'
        )->withPivot('rating', 'comment', 'created_at');
    }
}
